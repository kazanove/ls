<?php
return [
    'routes' => [
        '/404' => 'error',
        '/' . lng('lawyers_advocates') => 'lawyers_advocates',
    ],
    'name'=>[
        'lawyers_advocates' => '/' . lng('lawyers_advocates'),
        'expertise' => '/' . lng('expertise'),
        'notaries' => '/' . lng('notaries'),
        'blogs' => '/' . lng('blogs'),
        'about' => '/' . lng('about_project'),
        'main' => '/',
        'city' => '/' . lng('city'),
        'service' => '/' . lng('service') . '/[service]/[sub_service]',
        'feedback' => '/' . lng('feedback'),
        'password_recovery' => '/' . lng('password_recovery'),
        'login' => '/' . lng('login'),
        'personal_area' => '/' . lng('personal_area'),
        'registration' => '/' . lng('registration'),
        'send_confirm_email' => '/' . lng('send_confirm_email') . '/[email]',
    ]
];