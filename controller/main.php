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
$specialistTop = specialistTop($db, $city_id, config('module.specialistTop.count'));
$lawyersAdvocates = lawyersAdvocates($db, $city_id, config('module.lawyersAdvocates.count'));
$experts = experts($db, $city_id, config('module.experts.count'));
$metro = metro($db);
$notaries = notaries($db, $city_id, config('module.notaries.count'));
$currentSections = sections($db, config('module.current_sections'));
$usefulSections = sections($db, config('module.useful_sections'));
view('layout','main', compact('city', 'cities', 'classifications', 'services', 'url', 'specialistTop', 'currentSections', 'lawyersAdvocates', 'experts', 'notaries', 'usefulSections','metro'));

