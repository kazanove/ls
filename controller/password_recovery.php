<?php
/**
 * @var string $method
 * @var DataBase $db
 */
if ($method === 'POST') {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
        if ($user = $db->query('SELECT email, id FROM users WHERE email=:email LIMIT 1', [':email' => $_POST['email']])) {
            $user=$user[0];
            $string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $input_length = strlen($string);
            $random_string = '';
            for ($i = 0; $i < 10; $i++) {
                try {
                    $random_character = $string[random_int(0, $input_length - 1)];
                } catch (Exception $e) {
                    trigger_error('');
                }
                $random_string .= $random_character;
            }
            $password=$random_string;
            $db->query('UPDATE users SET password=:password WHERE id=:id',[':password'=>password_hash($password, PASSWORD_DEFAULT),':id'=>$user['id']]);
            send_mail($_POST['email'], lng('password_recovery'),'password_recovery',['email'=>$_POST['email'],'password'=>$password]);
            header('Content-Type: application/json; charset=utf-8');
            try {
                echo json_encode([
                    'code' => '0',
                    'message' => lng('message.new_password_sent_email'),
                ], JSON_THROW_ON_ERROR);
            } catch (JsonException $e) {
                trigger_error('');
            }
        } else {
            header('Content-Type: application/json; charset=utf-8');
            try {
                echo json_encode([
                    'code' => '1',
                    'message' => lng('message.email_address_not_registered'),
                ], JSON_THROW_ON_ERROR);
            } catch (JsonException $e) {
                trigger_error('');
            }
        }
    } else {
        trigger_error('');
    }
} else {
    trigger_error('');
}