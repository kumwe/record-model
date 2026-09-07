<?php

declare(strict_types=1);

namespace Kumwe\Record\Model\Tests;

use Kumwe\BusinessDefinition\Domain\EntityTypeDefinition;
use PHPUnit\Framework\TestCase;

final class DocumentConformanceTest extends TestCase
{
    public function testFrozenDocumentPlansRetainCanonicalDefinitionsAndPreparationFlags(): void
    {
        $root = dirname(__DIR__);
        $index = json_decode(
            file_get_contents($root . '/resources/conformance/v1.json'),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
        self::assertCount(7, $index['corpora']);
        $corpora = [];
        foreach ($index['corpora'] as $entry) {
            $corpora[$entry['id']] = $entry;
            $bytes = file_get_contents($root . '/' . $entry['path']);
            self::assertSame($entry['sha256'], hash('sha256', $bytes));
            $corpus = json_decode($bytes, true, 512, JSON_THROW_ON_ERROR);
            if (isset($entry['oracle_kind'])) {
                self::assertSame('unicode-runtime-differential', $entry['oracle_kind']);
                self::assertSame($entry['php'], $corpus['php']);
                self::assertSame($entry['icu'], $corpus['icu']);
                self::assertSame(0x110000 - 0x800, $corpus['scalar_count']);
                self::assertCount($entry['context_points'], $corpus['context_points']);
                self::assertSame(['lowercase', 'uppercase', 'unicode_nfc'], array_keys($corpus['sha256']));
                foreach ([...array_values($corpus['sha256']), $corpus['context_sha256']] as $digest) {
                    self::assertMatchesRegularExpression('/^[a-f0-9]{64}$/D', $digest);
                }
                continue;
            }
            self::assertSame($entry['schema'], $corpus['schema']);
            self::assertSame($entry['source_app'], $corpus['source_app']);
            self::assertCount($entry['fixtures'], $corpus['fixtures']);
            foreach ($corpus['fixtures'] as $fixture) {
                $definition = EntityTypeDefinition::fromArray($fixture['definition']);
                self::assertSame($fixture['definition'], $definition->toArray(), $fixture['id']);
                if (!isset($fixture['program'])) {
                    continue;
                }
                self::assertCount(count($definition->fields()), $fixture['program']['fields']);
                foreach ($definition->fields() as $position => $field) {
                    $preparation = $fixture['program']['fields'][$position];
                    self::assertSame($field->handle, $preparation['handle']);
                    self::assertSame(
                        in_array($field->type, ['core.uuid', 'core.reference_identity'], true),
                        $preparation['identity']
                    );
                    self::assertSame($field->type === 'core.sequence', $preparation['sequence']);
                    self::assertSame($field->computed || $field->formula !== null, $preparation['computed']);
                    self::assertSame($field->serverOnly, $preparation['server_only']);
                    self::assertSame($field->readOnly, $preparation['read_only']);
                    self::assertSame($field->immutableAfterCreate, $preparation['immutable_after_create']);
                    self::assertSame($field->visibilityCondition?->toArray(), $preparation['visibility_condition']);
                    self::assertSame($field->editabilityCondition?->toArray(), $preparation['editability_condition']);
                    $validation = $fixture['program']['validation']['fields'][$position];
                    self::assertSame($field->handle, $validation['handle']);
                    self::assertSame($field->required, $validation['required']);
                    self::assertSame($field->nullable, $validation['nullable']);
                    self::assertSame($field->formula?->toArray(), $validation['formula']);
                    self::assertSame($field->validators, $validation['validators']);
                    self::assertSame($field->type, $validation['type']);
                    self::assertSame($field->precision, $validation['precision']);
                    self::assertSame($field->scale, $validation['scale']);
                    self::assertSame($field->length, $validation['length']);
                    self::assertSame($field->normalizers, $validation['normalizers']);
                }
                $handles = array_column($fixture['input']['input'], 'handle');
                self::assertSame($handles, array_values(array_unique($handles)), $fixture['id']);
            }
        }
        self::assertCount(1, $index['profile_bundles']);
        foreach ($index['profile_bundles'] as $entry) {
            $bytes = file_get_contents($root . '/' . $entry['path']);
            self::assertSame($entry['sha256'], hash('sha256', $bytes));
            $bundle = json_decode($bytes, true, 512, JSON_THROW_ON_ERROR);
            self::assertSame($entry['profile'], $bundle['profile']);
            self::assertCount(6, $bundle['corpora']);
            foreach ($bundle['corpora'] as $bound) {
                self::assertArrayHasKey($bound['id'], $corpora);
                self::assertSame($bound['sha256'], $corpora[$bound['id']]['sha256']);
            }
        }
    }
}
