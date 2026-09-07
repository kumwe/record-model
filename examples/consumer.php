<?php

declare(strict_types=1);

require $argv[1] ?? dirname(__DIR__) . '/vendor/autoload.php';
\Kumwe\Record\Model\BusinessRecordRequestGuard::definition('acme.invoice');
$window = new \Kumwe\Record\Model\BusinessRecordReplayWindow();
if ($window->retentionSeconds <= $window->replaySeconds) {
    throw new RuntimeException('Replay retention mismatch.');
}
echo 'Package consumer behavior passed.' . PHP_EOL;
