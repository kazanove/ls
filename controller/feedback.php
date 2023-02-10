<?php
/**
 * @var string $method
 */
if ($method === 'POST') {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        send_mail(config('app.module.email.feedback'), 'Обратная связь', 'mail_feedback', ['email' => $_POST['email'],
            'message' => $_POST['message'],
        ]);
        try {
            echo json_encode(['code' => 0], JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            trigger_error('');
        }
    } else {
        header('Location: /405', true, 302);
        exit(405);
    }
} else {
    header('Location: /405', true, 302);
    exit(405);
}