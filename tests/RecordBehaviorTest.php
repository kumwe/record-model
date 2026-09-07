<?php

declare(strict_types=1);

namespace Kumwe\Record\Model\Tests;

use DateTimeImmutable;
use InvalidArgumentException;
use Kumwe\BusinessDefinition\Domain\ScopeMode;
use Kumwe\Record\Model\{BusinessRecord,BusinessRecordRevision,RecordMutationResult,RecordScope};
use Kumwe\Record\Value\ProtectedRecordValue;
use PHPUnit\Framework\TestCase;

final class RecordBehaviorTest extends TestCase
{
    private const ID = '018f4f24-98d8-7ad4-8f3f-38c909178b6b';
    public function testMutationPreservesOriginalAndIncrementsVersionOnce(): void
    {
        $now = new DateTimeImmutable('2026-01-01T00:00:00Z');
        $record = new BusinessRecord(
            self::ID,
            1,
            self::ID,
            'INV-1',
            RecordScope::reconstitute(
                ScopeMode::Site,
                'default',
                null
            ),
            1,
            null,
            ['amount' => '1.00'],
            'actor',
            $now,
            'actor',
            $now
        );
        $updated = $record->updated(['amount' => '2.00'], 'editor', $now->modify('+1 second'));
        self::assertSame(1, $record->version);
        self::assertSame('1.00', $record->value('amount'));
        self::assertSame(2, $updated->version);
        self::assertSame('2.00', $updated->value('amount'));
        $archived = $updated->archived('editor', $now);
        self::assertSame('editor', $archived->archivedBy);
        self::assertNull($archived->restored('editor', $now)->archivedAt);
        self::assertSame('editor', $updated->softDeleted('editor', $now)->deletedBy);
    }
    public function testRevisionChecksumPreservesProtectedStorageAndFieldSet(): void
    {
        $now = new DateTimeImmutable('2026-01-01T00:00:00Z');
        $marker = new ProtectedRecordValue(['version' => 1,'ciphertext' => 'AQ==']);
        $args = [self::ID,self::ID,1,'default',null,self::ID,str_repeat('a', 64),1,1,'update'];
        $a = new BusinessRecordRevision(...[...$args,['z' => $marker,'a' => null],['z','a','z'],'actor',$now]);
        $b = new BusinessRecordRevision(...[...$args,['a' => null,'z' => $marker],['a','z'],'actor',$now]);
        self::assertSame(['a','z'], $a->changedFields());
        self::assertSame($a->checksum(), $b->checksum());
        self::assertSame($marker, $a->snapshot()['z']);
    }
    public function testReplayRoundTripRetainsMutationPayload(): void
    {
        $result = new RecordMutationResult(self::ID, 2, self::ID, 'INV-1', 3, 'approved', 'update');
        $replay = $result->asReplay();
        self::assertTrue($replay->replayed);
        self::assertFalse($result->replayed);
        self::assertSame($result->toArray(), $replay->toArray());
        self::assertSame($result->toArray(), RecordMutationResult::fromArray($result->toArray())->toArray());
    }
    public function testMalformedRecordFieldCannotEnterSnapshot(): void
    {
        $now = new DateTimeImmutable('2026-01-01T00:00:00Z');
        $this->expectException(InvalidArgumentException::class);
        new BusinessRecord(
            self::ID,
            1,
            self::ID,
            'INV-1',
            RecordScope::reconstitute(
                ScopeMode::Site,
                'default',
                null
            ),
            1,
            null,
            [0 => 'not-a-handle'],
            'actor',
            $now,
            'actor',
            $now
        );
    }
}
