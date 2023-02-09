<?php

class DataBase
{
    private PDO $pdo;

    public function __construct(string|array $options)
    {
        if (is_string($options)) {
            $options = parse_url($options);
            $options['driver'] = $options['scheme'];
            $options['password'] = $options['pass'];
            $options['name'] = ltrim($options['path'], '/');
            $options['options'] = $options['query'];
            $params = explode('&', $options['options']);
            foreach ($params as $param) {
                [$key, $value] = explode('=', $param);
                $option[$key] = $value;
            }
            $options['options'] = $option;
            unset($options['scheme'], $options['pass'], $options['path'], $options['query']);
        }
        if (isset($options['options']['charset'])) {
            $options['options']['charset'] = str_replace('-', '', $options['options']['charset']);
        }
        if (isset($options['driver']) && in_array($options['driver'], PDO::getAvailableDrivers(), true)) {
            switch (strtolower($options['driver'])) {
                case 'mysql':
                {
                    if (isset($options['socket'])) {
                        $dsn = ';unix_socket=' . $options['unix_socket'];
                    } else {
                        $dsn = ';host=' . $options['host'] . ';port=' . ($options['port'] ?? '3306');
                    }
                    $dsn = $options['driver'] . ':dbname=' . $options['name'] . ';charset=' . ($options['options']['charset'] ?? 'utf8') . $dsn;
                    if (isset($options['options'])) {
                        $option = [PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT] + $options['options'];
                    }
                    $this->pdo = new PDO($dsn, $options['user'] ?? 'root', $options['password'] ?? '', $option);
                    $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
                    break;
                }
                default:
                {
                    throw new RuntimeException(printf('Драйвер %s не поддерживается.', $options['driver']));
                }
            }
        } else {
            throw new RuntimeException(printf('База данных %s не поддерживается.', $options['driver']));
        }
    }

    public function query(string $sql, array $params = []): array|int|null
    {
        if (($stm = $this->pdo->prepare($sql)) !== false) {
            foreach ($params as $param => $value) {
                if (is_string($value)) {
                    $type = PDO::PARAM_STR;
                } elseif (is_int($value)) {
                    $type = PDO::PARAM_INT;
                } elseif (is_null($value)) {
                    $type = PDO::PARAM_NULL;
                } elseif (is_float($value)) {
                    $type = PDO::PARAM_INT;
                } else {
                    //var_dump($value);
                    trigger_error('');
                }
                if (!$stm->bindValue($param, $value, $type)) {
                    trigger_error('');
                }
            }
            if ($stm->execute()) {
                $result = $stm->fetchAll();
                $s = strtoupper(substr($sql, 0, strpos($sql, ' ')));
                if ($s === 'SELECT') {
                    return $result;
                } elseif ($s === 'UPDATE') {
                    return $result;
                } elseif ($s === 'INSERT') {
                    return (int)$this->pdo->lastInsertId();
                } else {
                    var_dump($sql);
                    trigger_error('');
                }
                trigger_error('');
            } else {
                var_dump($sql);
                var_dump($stm->errorInfo());
                trigger_error('');
            }
        } else {
            trigger_error('');
        }
    }
}