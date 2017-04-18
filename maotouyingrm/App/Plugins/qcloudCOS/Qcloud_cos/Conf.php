<?php
namespace Qcloud_cos;

class Conf
{
    const PKG_VERSION = 'v3.3'; 

    const API_IMAGE_END_POINT = 'http://web.image.myqcloud.com/photos/v1/';
    const API_VIDEO_END_POINT = 'http://web.video.myqcloud.com/videos/v1/';
    const API_COSAPI_END_POINT = 'http://web.file.myqcloud.com/files/v1/';
    //请到http://console.qcloud.com/cos去获取你的appid、sid、skey
    const APPID = '10063106';
    const SECRET_ID = 'AKIDeumz7ZVID4gsgc8UuiWije1qItS5oWFV';
    const SECRET_KEY = 'KeyBPvU1UGz9u0TiDN5G5LKdNgOrhErL';


    public static function getUA() {
        return 'cos-php-sdk-'.self::PKG_VERSION;
    }
}

//end of script
