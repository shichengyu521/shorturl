<?php

/**
 * Created by PhpStorm.
 * Author: mingbai
 * Date: 19-4-11
 * Time: 下午4:57
 */

namespace ShortUrl;

/**
 * Class ShortUrl
 * @package ShortUrl
 */

class ShortUrl
{
    /**
     * 短网址
     * @param string $long_url 长链接
     * @return mixed
     */
    public static function shortUrl($long_url = '')
    {
        if (!$long_url) {
            return self::toJson(404, 'failed', '');
        }
        $app_key = 'c5faa6d67402859b6366ada95671c017';
        $long_url = urlencode($long_url);
        $url = "http://www.mynb8.com/api2/sina?appkey=" . $app_key . "&long_url=" . $long_url;
        $json = file_get_contents($url);
        $url = json_decode(stripslashes($json), true);
        return self::toJson(0,'success',$url['short_url']);
    }

    public function toJson($code = 0, $msg = '', $url = '')
    {
        $result['code'] = $code;
        $result['msg'] = $msg;
        $result['url'] = $url;
        return $result;
    }
}