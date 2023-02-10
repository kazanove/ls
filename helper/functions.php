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
        if (file_exists($path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'language' . DIRECTORY_SEPARATOR . 'ru' . DIRECTORY_SEPARATOR . $param . '.php')) {
            if (!is_array($languages[$param] = include $path)) {
                trigger_error('');
            }
        } else {
            return str_replace('_', ' ', $value);
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

function view(string $layout, string $template, array $params = []): void
{
    if ($params) {
        extract($params, EXTR_OVERWRITE);
    }
    if (!file_exists($content = config('view.path') . $template . '.php')) {
        throw new RuntimeException('Шаблон "' . $template . '" не найден.');
    }
    if (!file_exists($path = config('view.path') . 'layouts' . DIRECTORY_SEPARATOR . $layout . '.php')) {
        throw new RuntimeException('Макет "' . $layout . '" не найден.');
    }
    include $path;
}

function user(): bool|int
{
    if (isset($_SESSION['user']['id'], $_SESSION['user']['token']) && password_verify($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'] . config('app.key'), $_SESSION['user']['token'])) {
        return $_SESSION['user']['id'];
    }
    return false;
}

function asset(string $param): string
{
    return host() . ltrim($param, '/');
}

function host(): string
{
    return 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . '/';
}

function route(string $name, array $params = []): string
{
    if (($routes = config('router.name')) !== null) {
        if (!isset($routes[$name])) {
            throw new RuntimeException('Маршрут "' . $name . '" не существует.');
        }
        $route = $routes[$name];
        if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $index => $match) {
                [
                    $block,
                    $pre,
                    $type,
                    $param,
                    $optional,
                ] = $match;
                if ($pre) {
                    $block = substr($block, 1);
                }
                if (isset($params[$type])) {
                    $route = str_replace($block, $params[$type], $route);
                } elseif ($optional && $index !== 0) {
                    trigger_error('');
                    $url = str_replace($pre . $block, '', $url);
                } else {
                    $route = str_replace($block, '', $route);
                }
            }
        }
        return rtrim(host(), '/') . str_replace(' ', '_', mb_strtolower($route, 'UTF-8'));
    }
    throw new RuntimeException('Не найдены название параметров маршрутов.');
}

function csrf(int $len = 10): string
{
    if (!isset($_SESSION['token_id'])) {
        if (function_exists('openssl_random_pseudo_bytes')) {
            try {
                $_SESSION['token_id'] = substr(bin2hex(random_bytes((int)(($len / 2) + 1))), 0, $len);
                $_SESSION['token_value'] = hash('sha256', substr(bin2hex(random_bytes((int)(($len * 10 / 2) + 1))), 0, $len));
            } catch (Exception $e) {
                trigger_error('');
            }
        } else {
            trigger_error('');
        }
    }
    return '<input name="' . $_SESSION['token_id'] . '" value="' . $_SESSION['token_value'] . '" hidden>' . "\n";
}