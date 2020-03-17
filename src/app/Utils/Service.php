<?php
namespace Utils;

class Service extends \Prefab
{
    public static function call($method = '', $params = [], $async = true)
    {
        $wd = getcwd();
        $ds = DIRECTORY_SEPARATOR;

        $command = 'php ' . $wd . $ds . 'index.php' . ' /cli/' . $method;
        if (is_string($params) || is_numeric($params)) {
            $command .= ' ' . escapeshellarg($params);
        } elseif(is_array($params)) {
            $command .= ' ' . implode(' ', array_map('escapeshellarg', $params));
        }

        if ($async) {
            $command = PHP_OS === 'WINNT' ? 'start /b '.$command : $command.' > /dev/null 2>/dev/null &';
        }

        $output = [];

        exec($command, $output);

        return $output;
    }
}
