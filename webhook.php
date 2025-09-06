<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$secret = 'RDk7w0jl77';

// Create logs directory if it doesn't exist
if (!is_dir('/opt/bitnami/apache/htdocs/logs')) {
    shell_exec('sudo mkdir -p /opt/bitnami/apache/htdocs/logs');
    shell_exec('sudo chmod 775 /opt/bitnami/apache/htdocs/logs');
}

// Log webhook call
file_put_contents(
    '/opt/bitnami/apache/htdocs/logs/webhook-debug.log',
    date('Y-m-d H:i:s') . " - Webhook called\n",
    FILE_APPEND | LOCK_EX
);

$payload = file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

file_put_contents(
    '/opt/bitnami/apache/htdocs/logs/webhook-debug.log',
    "Payload length: " . strlen($payload) . "\n",
    FILE_APPEND | LOCK_EX
);
file_put_contents(
    '/opt/bitnami/apache/htdocs/logs/webhook-debug.log',
    "Signature received: " . $sig_header . "\n",
    FILE_APPEND | LOCK_EX
);

$expected_signature = 'sha256=' . hash_hmac('sha256', $payload, $secret);
file_put_contents(
    '/opt/bitnami/apache/htdocs/logs/webhook-debug.log',
    "Expected signature: " . $expected_signature . "\n",
    FILE_APPEND | LOCK_EX
);

if (hash_equals($expected_signature, $sig_header)) {
    file_put_contents(
        '/opt/bitnami/apache/htdocs/logs/webhook-debug.log',
        "✅ Signature verified - running deployment\n",
        FILE_APPEND | LOCK_EX
    );

    // Run git pull with sudo
    $output = shell_exec('cd /opt/bitnami/apache/htdocs && sudo git pull origin main 2>&1');

    // Fix permissions with sudo
    shell_exec('sudo chown -R daemon:daemon /opt/bitnami/apache/htdocs');
    shell_exec('sudo chmod -R 755 /opt/bitnami/apache/htdocs');

    // Log deployment
    file_put_contents('/opt/bitnami/apache/htdocs/logs/deploy.log', date('Y-m-d H:i:s') . " - Deployed successfully: " .
        trim($output) . "\n", FILE_APPEND | LOCK_EX);
    file_put_contents('/opt/bitnami/apache/htdocs/logs/webhook-debug.log', "Git output: " . trim($output) . "\n", FILE_APPEND
        | LOCK_EX);

    http_response_code(200);
    echo "🎉 Deployment successful!";
} else {
    file_put_contents('/opt/bitnami/apache/htdocs/logs/webhook-debug.log', "❌ Signature verification failed\n", FILE_APPEND |
        LOCK_EX);
    http_response_code(403);
    echo "❌ Forbidden - Invalid signature";
}
