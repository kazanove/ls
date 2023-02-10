<?php
/**
 * @var array $cities
 * @var string $url
 * @var string $city
 * @var array $classifications
 * @var string $services
 * @var DataBase $db
 */
include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'beforeController.php';

$specialists = $db->query('select s.id as id, CONCAT(s.name,\' \',s.surname) AS name , s.classification_id AS classification, s.city_id AS city, s.photo AS photo, r.rating AS rating, s.tarif_id as tarif from specialists as s  LEFT JOIN ratings r ON r.specialist_id = s.id where city_id = :city and date_end_tarif > NOW() and (classification_id =1 or classification_id=2 or classification_id=5 or classification_id=6) ORDER BY tarif DESC, s.date_end_tarif DESC, rating DESC', [
    ':city' => $_COOKIE['city'] ?? $cities[0]['id'] ?? null,
]);
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
    $spls[] = $s;
}

view('layout', 'services', compact('cities', 'url', 'city', 'classifications', 'sp', 'services'));
