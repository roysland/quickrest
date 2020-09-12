<?php

namespace Pageup\Base;

class Str {
    public static function kebab ($text) {
        return $text;
    }

    public static function random ($length) {
        $string = '';
        while (($len = strlen($string)) < $length) {
            $size = $length - $len;
            $bytes = random_bytes($size);
            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }
        return $string;
    }

    public static function slug($text) {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
    }
}