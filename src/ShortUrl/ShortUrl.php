<?php

/**
 * Created by PhpStorm.
 * Author: mingbai
 * Date: 19-4-11
 * Time: 下午4:57
 */

class ShortUrl
{
    /**
     * 生成短网址
     * @param string $longUrl 长网址
     * @return array 短网址
     */
    public static function toShortUrl($longUrl = ''){
        $base32 = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
            'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
            'q', 'r', 's', 't', 'u', 'v', 'w', 'x',
            'y', 'z', '0', '1', '2', '3', '4', '5'
        );

        $hex = md5($longUrl);
        $hexLen = strlen($hex);
        $subHexLen = $hexLen / 8;
        $shortUrl = array();
        for ($i = 0; $i < $subHexLen; $i++) {
            // 把加密字符按照8位一组16进制与0x3FFFFFFF(30位1)进行位与运算
            $subHex = substr($hex, $i * 8, 8);
            $int = 0x3FFFFFFF & (1 * ('0x' . $subHex));
            $out = '';
            for ($j = 0; $j < 6; $j++) {
                // 把得到的值与0x0000001F进行位与运算，取得字符数组chars索引
                $val = 0x0000001F & $int;
                $out .= $base32[$val];
                $int = $int >> 5;
            }
            $shortUrl[] = $out;
        }
        return $shortUrl;
    }
}