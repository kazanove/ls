<?php
/**
 * @var $method string
 */
if ($method === 'GET') {
    if (isset($_GET['term'])) {
        $cities = (include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'language' . DIRECTORY_SEPARATOR . 'ru' . DIRECTORY_SEPARATOR . 'cities.php');
        if ($matches = preg_grep('/^' . $_GET['term'] . '/iu', $cities)) {
            header('Content-Type: application/json; charset=utf-8');
            foreach ($matches as $id => $city) {
                $result[] = [
                    'id' => $id,
                    'value' => $city
                ];
            }
            try {
                echo json_encode($result ?? [], JSON_THROW_ON_ERROR);
            } catch (JsonException $e) {
                trigger_error('');
            }
        } else {
            trigger_error('');
        }
    }
} else {
    trigger_error('');
}