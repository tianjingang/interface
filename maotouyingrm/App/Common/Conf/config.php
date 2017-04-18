<?php
return array(

    'URL_MODEL'         => 2,   //URL模式
    'MODULE_ALLOW_LIST' => array('Home'),
    'DEFAULT_MODULE'    =>  'Home',
    
    'DATA_CACHE_TYPE' =>  'Redis',        // 缓存类型
//    'REDIS_HOST' =>  '123.57.10.201',  // 缓存服务器地址
//    'REDIS_AUTH' =>  'ZFPCQ14Irff0o0K139',  // 缓存服务器密码
        'REDIS_HOST' =>  '127.0.0.1',  // 缓存服务器地址
    'REDIS_AUTH' =>  'uBX9m1bO1XKn',  // 缓存服务器密码
    'REDIS_PORT' =>  '6379',          // 缓存时间
    'REDIS_CACHE_PREFIX'=>'mr_',              // 缓存前缀
//    'SESSION_TYPE' => 'Redis', //session保存类型
//    'SESSION_EXPIRE' => 3600, //SESSION过期时间
);