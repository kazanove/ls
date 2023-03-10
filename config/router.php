<?php
return [
    'routes' => [
        '/404' => 'error',
        '/' . lng('lawyers_advocates') => 'lawyers_advocates',
        '/' . lng('expertise') => 'expertise',
        '/' . lng('notaries') => 'notaries',
        '/' . lng('blogs') => 'blogs',
        '/' . lng('about_project') => 'about',
        '/' => 'main',
        '/' . lng('city') => 'city',
        '/' . lng('service') . '/[service]' => 'service',
         '/' . lng('services') . '/[service]/[sub_service]'=>'services',
        '/' . lng('feedback')=> 'feedback',
        '/' . lng('password_recovery')=>'password_recovery',
    ],
    'name' => [
        'lawyers_advocates' => '/' . lng('lawyers_advocates'),
        'expertise' => '/' . lng('expertise'),
        'notaries' => '/' . lng('notaries'),
        'blogs' => '/' . lng('blogs'),
        'about' => '/' . lng('about_project'),
        'main' => '/',
        'city' => '/' . lng('city'),
        'service' => '/' . lng('service') . '/[service]',
        'services' => '/' . lng('services') . '/[service]/[sub_service]',
        'feedback' => '/' . lng('feedback'),
        'password_recovery' => '/' . lng('password_recovery'),
        'login' => '/' . lng('login'),
        'personal_area' => '/' . lng('personal_area'),
        'registration' => '/' . lng('registration'),
        'send_confirm_email' => '/' . lng('send_confirm_email') . '/[email]',
        'section' => '/' . lng('section') . '/[section]',
        'all_sections' => '/' . lng('all_sections'),
        'filter' => '/' . lng('filter'),
    ],
];