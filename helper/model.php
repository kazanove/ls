<?php
function services(DataBase $db): array
{
    $services = $db->query('SELECT id, sub_id, classification_id FROM services');
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