<?php
/**
 * @var DataBase $db
 * @var array $cities
 * @var string $city
 * @var array $classifications
 * @var int $countServicesLS
 * @var array $services
 * @var string $url
 */
view('layout','404', compact('city', 'cities', 'classifications',  'services', 'url'));