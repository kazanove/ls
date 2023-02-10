<?php
include __DIR__ . DIRECTORY_SEPARATOR . 'helper' . DIRECTORY_SEPARATOR . 'functions.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'helper' . DIRECTORY_SEPARATOR . 'model.php';

if (spl_autoload_register(static function (string $class) {
        if (file_exists($path = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php')) {
            include $path;
        }
    }, true, true) === false) {
    throw new RuntimeException(lng('error.autoload.register'));
}
if ((session_status() === PHP_SESSION_NONE) && session_start(config('session') ?? []) === false) {
    throw new RuntimeException(lng('error.session.start'));
}
$method = strtoupper($_SERVER['REQUEST_METHOD']);
if ($method === 'POST') {
    if (!isset($_SESSION['token_id'], $_SESSION['token_value'], $_POST[$_SESSION['token_id']])) {
        trigger_error('');
        die();
    } else {
        if ($_SESSION['token_value'] !== $_POST[$_SESSION['token_id']]) {
            trigger_error('');
            die();
        }
    }
} else {
    unset($_SESSION['token_id'], $_SESSION['token_value']);
}
$db = new DataBase(config('database.dsn'));
$router = config('router.routes');
if (isset($router)) {
    foreach ($router as $route => $callback) {
        $routers[mb_strtolower(str_replace(' ', '_', $route), 'UTF-8')] = $callback;
    }
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $url = '/' . trim($url, '/');
    $url = mb_strtolower($url);
    $url = urldecode($url);
    if (isset($routers[$url])) {
        if (is_string($routers[$url])) {
            if (file_exists($controller = __DIR__ . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . $routers[$url] . '.php')) {
                include __DIR__ . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'beforeController.php';
                include $controller;
                exit(200);
            }
            header('Location: /404', true, 302);
            exit(302);
        }
        trigger_error('');
    } else {
        foreach ($routers as $route => $callback) {
            if (!str_contains($route, '[')) {
                continue;
            }
            if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    [
                        $block,
                        $pre,
                        $type,
                        $param,
                        $optional,
                    ] = $match;
                    $pattern = '(?:'
                        . ($pre !== '' ? $pre : null)
                        . '('
                        . ($type !== '' ? "?P<$type>" : null)
                        . '[A-Za-zА-яа-я0-9,_ ]+'
                        . ')'
                        . $optional
                        . ')'
                        . $optional;
                    $route = str_replace($block, $pattern, $route);
                }
                $regex = '`^' . $route . '$`u';
                if (($match = preg_match($regex, $url, $params)) === 1) {
                    foreach ($params as $key => $value) {
                        if (is_numeric($key)) {
                            unset($params[$key]);
                        }
                    }
                    if (is_string($callback)) {
                        if (file_exists($controller = __DIR__ . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . $callback . '.php')) {
                            extract($params, EXTR_OVERWRITE);
                            include __DIR__ . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'beforeController.php';
                            include $controller;
                            exit(200);
                        }
                        header('Location: /404', true, 302);
                        exit(404);
                    }
                    trigger_error('');
                    die();
                }
            }
        }
        trigger_error('');die();
        if ($url !== '/404') {
            header('Location: /404', true, 302);
            exit(404);
        }
        http_response_code(404);
    }

} else {
    http_response_code(500);
}