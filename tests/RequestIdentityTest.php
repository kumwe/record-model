<?php

declare(strict_types=1);

namespace Kumwe\Record\Model\Tests;

use InvalidArgumentException;
use Kumwe\Record\Model\BusinessRecordRequestGuard;
use PHPUnit\Framework\TestCase;

final class RequestIdentityTest extends TestCase
{
    public function testCanonicalRequestIdentityAndConcurrencyGrammar(): void
    {
        BusinessRecordRequestGuard::definition('acme.invoice');
        BusinessRecordRequestGuard::definition('018f4f24-98d8-7ad4-8f3f-38c909178b6b');
        BusinessRecordRequestGuard::record('INV-1');
        BusinessRecordRequestGuard::handle('approve', 'action');
        BusinessRecordRequestGuard::organization('Europe-West');
        BusinessRecordRequestGuard::approval(null);
        BusinessRecordRequestGuard::version(1);
        $this->addToAssertionCount(7);
        $this->expectException(InvalidArgumentException::class);
        BusinessRecordRequestGuard::version(0);
    }

    public function testUnboundedRecordIdentityIsRefused(): void
    {
        $this->expectException(InvalidArgumentException::class);
        BusinessRecordRequestGuard::record(str_repeat('x', 192));
    }
}
