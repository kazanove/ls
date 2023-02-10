<?php

/**
 * @var DataBase $db
 * @var array $cities
 * @var string $city
 * @var array $classifications
 * @var array $services
 * @var string $url
 */
$city_id = $_COOKIE['city'] ?? $cities[0]['id']??null;
$specialists = notaries($db, $city_id);
$sp = [];
foreach ($specialists as $specialist) {
    $s = $specialist;
    $s['city'] = lng('cities.' . $specialist['city']);
    $s['classification'] = lng('classification.' . $specialist['classification']);
    $services_provider = $db->query('select * from services_provided sp where specialist_id = :id', [':id' => $specialist['id']]);
    if (isset($services_provider[0])) {
        $s['services_provider'] = lng('services.' . $services_provider[0]['service'] . '.title');
    }
    if (!is_file(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . $s['photo'])) {
        $s['photo'] = 'avatar_default.png';
    }
    $s['services_provider_count'] = count($services_provider);
    $sp[] = $s;
}
view('layout','services', compact('city', 'cities', 'classifications', 'sp', 'services', 'url', 'specialists'));