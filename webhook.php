<?php
$secret = 'RDk7w0jl77';

if (!is_dir('/opt/bitnami/apache/htdocs/logs')) {
    shell_exec('sudo mkdir -p /opt/bitnami/apache/htdocs/logs');
    shell_exec('sudo chmod 775 /opt/bitnami/apache/htdocs/logs');
}

$payload = file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$expected_signature = 'sha256=' . hash_hmac('sha256', $payload, $secret);

if (hash_equals($expected_signature, $sig_header)) {
    // FORCE GitHub as source of truth
    $commands = [
        'cd /opt/bitnami/apache/htdocs',
        'sudo git fetch origin main',
        'sudo git reset --hard origin/main',
        'sudo git clean -fd'
    ];

    $output = shell_exec(implode(' && ', $commands) . ' 2>&1');

    shell_exec('sudo chown -R daemon:daemon /opt/bitnami/apache/htdocs');
    shell_exec('sudo chmod -R 755 /opt/bitnami/apache/htdocs');

    file_put_contents('/opt/bitnami/apache/htdocs/logs/deploy.log', date('Y-m-d H:i:s') . " - FORCE DEPLOYED (GitHub = truth):
   " . trim($output) . "\n", FILE_APPEND | LOCK_EX);

    http_response_code(200);
    echo "🎉 Force deployment successful! GitHub is truth.";
} else {
    http_response_code(403);
    echo "❌ Forbidden";
}
