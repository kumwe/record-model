<?php

declare(strict_types=1);

namespace Kumwe\Record\Model\Tests;

use PHPUnit\Framework\TestCase;

final class ValueImmutabilityTest extends TestCase
{
    public function testRecordAndRevisionDetachNestedCallerReferences(): void
    {
        $id = '018f4f24-98d8-7ad4-8f3f-38c909178b6b';
        $now = new \DateTimeImmutable('2026-01-01T00:00:00Z');
        $value = 'approved';
        $values = ['payload' => ['state' => &$value]];
        $record = new \Kumwe\Record\Model\BusinessRecord(
            $id,
            1,
            $id,
            'INV-1',
            \Kumwe\Record\Model\RecordScope::reconstitute(
                \Kumwe\BusinessDefinition\Domain\ScopeMode::Site,
                'default',
                null
            ),
            1,
            null,
            $values,
            'actor',
            $now,
            'actor',
            $now
        );
        $revision = new \Kumwe\Record\Model\BusinessRecordRevision(
            $id,
            $id,
            1,
            'default',
            null,
            $id,
            str_repeat(
                'a',
                64
            ),
            1,
            1,
            'update',
            $values,
            ['payload'],
            'actor',
            $now
        );
        $checksum = $revision->checksum();
        $value = 'changed';
        self::assertSame(['state' => 'approved'], $record->value('payload'));
        self::assertSame($checksum, $revision->checksum());
        $copy = $revision->snapshot();
        $copy['payload']['state'] = 'returned-copy';
        self::assertSame($checksum, $revision->checksum());
    }

    public function testRevisionRejectsUnboundedFieldsAndMalformedActors(): void
    {
        $id = '018f4f24-98d8-7ad4-8f3f-38c909178b6b';
        $fields = [];
        for ($i = 0; $i < 257; ++$i) {
            $fields['f' . $i] = null;
        }
        foreach ([[$fields, 'actor'], [[], "actor\ninvalid"]] as [$snapshot, $actor]) {
            try {
                new \Kumwe\Record\Model\BusinessRecordRevision(
                    $id,
                    $id,
                    1,
                    'default',
                    null,
                    $id,
                    str_repeat(
                        'a',
                        64
                    ),
                    1,
                    1,
                    'update',
                    $snapshot,
                    [],
                    $actor,
                    new \DateTimeImmutable('2026-01-01T00:00:00Z')
                );
                self::fail('Malformed revision was admitted.');
            } catch (\InvalidArgumentException) {
                self::assertTrue(true);
            }
        }
    }
}
