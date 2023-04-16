<?php

if (! function_exists('cleanData')) {
    function cleanData($data): array|string
    {
        if (is_array($data)) {
            return array_map(static function ($each) {
                return addslashes($each);
            }, $data);
        }

        return addslashes($data);
    }
}