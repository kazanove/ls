<?php
function lng(string $value, bool $toUp = true): string|array
{
    static $languages = [];
    $v = $value;
    if (str_contains($value, '.')) {
        [
            $param,
            $value,
        ] = explode('.', $value, 2);
    } else {
        $param = 'string';
    }
    if (!isset($languages[$param])) {
        if (file_exists($path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Language' . DIRECTORY_SEPARATOR . 'ru' . DIRECTORY_SEPARATOR . $param . '.php')) {
            if (!is_array($languages[$param] = include $path)) {
                trigger_error('');
            }
        } else {
            return $value;
        }
    }
    $lng = $languages[$param];
    $keys = explode('.', $value);
    foreach ($keys as $k) {
        $lng = $lng[$k] ?? $v;
    }
    if ($toUp) {
        $lng = mb_strtoupper(mb_substr($lng, 0, 1, 'UTF-8'), 'UTF-8') . mb_substr($lng, 1, null, 'UTF-8');
    }
    return $lng;
}
function config(string $param): array|string|null|int
{
    static $config = [];
    $keys = explode('.', $param);
    $path = array_shift($keys);
    if (!isset($config[$path])) {
        if (file_exists($pathTo = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $path . '.php')) {
            if (is_array($cfg = include $pathTo)) {
                $config[$path] = $cfg;
            } else {
                throw new RuntimeException('Файл конфигурации "' . $path . '" поврежден.');
            }
        } else {
            throw new RuntimeException('Файл конфигурации "' . $path . '" отсутствует.');
        }
    }
    if (count($keys) === 0) {
        return $config[$path];
    }
    $cfg = $config[$path];
    foreach ($keys as $k) {
        if (isset($cfg[$k])) {
            $cfg = $cfg[$k];
        } else {
            return null;
        }
    }
    return $cfg;
}