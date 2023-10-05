<?php

namespace App\modules\view;

class View
{
    private static $path;
    private static ?array $data;

    public static function view(string $str, ?array $data =[])
    {
        self::$data = $data;
        $path = str_replace('public', '', ($_SERVER['DOCUMENT_ROOT'] . '\app\resources\views\\'));
        self::$path = $path . $str . '.php';
        return self::getContent();
    }

    private static function getContent()
    {
        extract(self::$data);
        ob_start();
        include self::$path;
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }
}