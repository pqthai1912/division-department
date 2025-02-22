<?php

namespace App\Utils;

class JapaneseUtil
{
    static function isKanji($str)
    {
        return preg_match('/[\x{4E00}-\x{9FBF}]/u', $str) > 0;
    }

    static function isHiragana($str)
    {
        return preg_match('/[\x{3040}-\x{309F}]/u', $str) > 0;
    }

    static function isKatakana($str)
    {
        return preg_match('/[\x{30A0}-\x{30FF}]/u', $str) > 0;
    }
    static function isJapanese($str)
    {
        return (preg_match('/[\x{4E00}-\x{9FBF}]/u', $str) > 0) ||
                preg_match('/[\x{3040}-\x{309F}]/u', $str) > 0 ||
                preg_match('/[\x{30A0}-\x{30FF}]/u', $str) > 0;
    }
}
