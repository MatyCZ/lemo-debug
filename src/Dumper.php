<?php

namespace Lemo\Debug;

class Dumper
{
    public static $typeToJson = [
        'application/json'
    ];

    /**
     * @param mixed $value
     */
    public static function dump($value)
    {
        $headerAccept = $_SERVER['HTTP_ACCEPT'] ? trim(strtolower($_SERVER['HTTP_ACCEPT'])) : null;
        $headerContentType = $_SERVER['HTTP_CONTENT_TYPE'] ? trim(strtolower($_SERVER['HTTP_CONTENT_TYPE'])) : null;

        if (in_array($headerAccept, self::$typeToJson)) {
            self::toJson($value);
        } elseif (in_array($headerContentType, self::$typeToJson)) {
            self::toJson($value);
        } else {
            self::toHtml($value);
        }
    }

    /**
     * @param mixed $value
     */
    public static function dumpWithExit($value)
    {
        self::dump($value);
        exit;
    }

    /**
     * @param mixed $value
     */
    private static function toHtml($value)
    {
        header('Content-type: text/html');

        echo "<pre>";
        var_dump($value);
        echo "</pre>";
    }

    /**
     * @param mixed $value
     */
    private static function toJson($value)
    {
        header('Content-type: application/json');

        echo json_encode($value);
    }
}