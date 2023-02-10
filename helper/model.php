<?php
function services(DataBase $db): array
{
    $services = $db->query('SELECT id, sub_id, classification_id FROM services');
    if (!function_exists('recursive')) {
        function recursive(array $data, int $id = 0): array
        {
            $_row = [];
            foreach ($data as $row) {
                if ((int)$row['sub_id'] === $id) {
                    $_row[] = [
                        'id' => (int)$row['id'],
                        'c_id' => (int)$row['classification_id'],
                        'sub' => recursive($data, $row['id']),
                    ];
                }
            }
            return $_row;
        }
    }

    return recursive($services);
}

function classifications(DataBase $db): array
{
    return $db->query('SELECT * FROM classifications');
}

function topCities(DataBase $db, int $limit = 0): array
{
    if ($limit === 0) {
        $params = [];
        $limit = '';
    } else {
        $params[':limit'] = $limit;
        $limit = ' LIMIT ' . $limit;
    }
    $cities = $db->query('select count(city_id) as count, city_id from specialists s  group by city_id  order by count desc, city_id asc ' . $limit, $params);
    foreach ($cities as $city) {
        $c[] = [
            'id' => $city['city_id'],
            'title' => lng('cities.' . $city['city_id']),
        ];
    }
    return $c ?? [];
}
function experts(DataBase $db, ?int $city_id, int $limit = 0): array
{
    $params[':city'] = $city_id;
    if ($limit === 0) {
        $l = '';
    } else {
        $l = 'LIMIT :limit';
        $params[':limit'] = $limit;
    }
    $specialists = $db->query('SELECT s.id as id, CONCAT(s.name,\' \',s.surname) AS name , s.classification_id AS classification, s.city_id AS city, s.photo AS photo, r.rating AS rating,  s.tariff_id as tarif FROM specialists s LEFT JOIN ratings r ON r.specialist_id = s.id WHERE city_id = :city AND	date_end_tarif > NOW()  AND (s.classification_id=3 or s.classification_id=7) ORDER BY tariff_id DESC, date_end_tarif DESC, r.rating DESC '.$l, $params);
    return getArr($specialists, $db);
}
/**
 * @param array $specialists
 * @param DataBase $db
 * @return array
 */
function getArr(array $specialists, DataBase $db): array
{
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
        $result[] = $s;
    }
    return $result ?? [];
}

function notaries(DataBase $db, int $city_id, int $limit = 0): array
{
    $params[':city'] = $city_id;
    if ($limit === 0) {
        $l = '';
    } else {
        $l = 'LIMIT :limit';
        $params[':limit'] = $limit;
    }
    $specialists = $db->query('SELECT s.id as id, CONCAT(s.name,\' \',s.surname) AS name , s.classification_id AS classification, s.city_id AS city, s.photo AS photo, r.rating AS rating,  s.tariff_id as tarif FROM specialists s LEFT JOIN ratings r ON r.specialist_id = s.id WHERE city_id = :city AND	date_end_tarif > NOW()  AND (s.classification_id=4 or s.classification_id=8) ORDER BY tariff_id DESC, date_end_tarif DESC, r.rating DESC '.$l,$params);
    return getArr($specialists, $db);
}