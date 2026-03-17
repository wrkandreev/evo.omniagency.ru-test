<?php

declare(strict_types=1);

header('Content-Type: text/plain; charset=UTF-8');

$secret = $_GET['secret'] ?? $_SERVER['HTTP_X_DEPLOY_SECRET'] ?? '';
$expectedSecret = defined('DEPLOY_PULL_SECRET') ? constant('DEPLOY_PULL_SECRET') : '';

if ($expectedSecret === '' || !hash_equals($expectedSecret, (string) $secret)) {
    http_response_code(403);
    echo "Forbidden\n";
    exit;
}

$projectRoot = __DIR__;
$branch = 'main';

$run = static function (string $command) use ($projectRoot): array {
    $descriptorSpec = [
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w'],
    ];

    $process = proc_open($command, $descriptorSpec, $pipes, $projectRoot);

    if (!is_resource($process)) {
        return [1, '', 'Failed to start process'];
    }

    $stdout = stream_get_contents($pipes[1]);
    fclose($pipes[1]);

    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[2]);

    $exitCode = proc_close($process);

    return [$exitCode, trim($stdout), trim($stderr)];
};

[$currentCode, $beforeHead, $currentError] = $run('git rev-parse HEAD');

if ($currentCode !== 0) {
    http_response_code(500);
    echo "Cannot read current revision\n\n";
    echo $currentError . "\n";
    exit;
}

[$pullCode, $pullStdout, $pullStderr] = $run('git pull origin ' . escapeshellarg($branch) . ' 2>&1');

$pullOutput = trim($pullStdout . "\n" . $pullStderr);

[$newCode, $afterHead, $newError] = $run('git rev-parse HEAD');

if ($newCode !== 0) {
    http_response_code(500);
    echo "Cannot read new revision\n\n";
    echo $newError . "\n";
    exit;
}

[$filesCode, $filesStdout, $filesStderr] = $run('git diff --name-status ' . escapeshellarg($beforeHead) . ' ' . escapeshellarg($afterHead));

if ($pullCode !== 0) {
    http_response_code(500);
}

echo "Deploy pull\n";
echo "Before: {$beforeHead}\n";
echo "After:  {$afterHead}\n";
echo "Status: " . ($pullCode === 0 ? 'ok' : 'failed') . "\n\n";

echo "Pull output:\n";
echo ($pullOutput !== '' ? $pullOutput : '[no output]') . "\n\n";

echo "Changed files:\n";

if ($filesCode === 0 && $filesStdout !== '') {
    echo $filesStdout . "\n";
} elseif ($beforeHead === $afterHead) {
    echo "No changes pulled\n";
} else {
    echo ($filesStderr !== '' ? $filesStderr : 'Unable to determine changed files') . "\n";
}
