<?php
/**
 * @var DataBase $db
 * @var string $url
 */
$classifications = classifications($db);
//$countServicesLS = $db->query('SELECT COUNT(*) FROM services WHERE classification_id=1')[0]['COUNT(*)'];
$services = services($db);
$cities = topCities($db);
if (isset($_COOKIE['city'])) {
    $city = lng('cities.' . $_COOKIE['city']);
} else {
    if (isset($cities[0]['title'])) {
        $city = $cities[0]['title'];
    } else {
        $city = '';
    }
}
