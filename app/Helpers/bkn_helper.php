<?php

if (!function_exists('maskName')) {
    function maskName($name)
    {
        $firstFour = substr($name, 0, 4);
        $length = strlen($name) - 4;
        if ($length <= 0) {
            return $name;
        }

        $masked = str_repeat('x', $length);
        return $firstFour . $masked;
    }
}
