<?php
    defined('IMAGE_DOMAIN')   or define('IMAGE_DOMAIN',  'http://img.huoxing.appflint.com/@');
    defined('ASSETS_DOMAIN')  or define('ASSETS_DOMAIN', BASE_URL . 'assets/');
    defined('HELP')  or define('HELP', BASE_URL . 'help/');
    defined('VIDEO_UPLOAD_URL') or define('VIDEO_UPLOAD_URL', BASE_URL . 'upload');
    defined('PLUGINS_PATH') or define('PLUGINS_PATH', APP_PATH . 'Plugins' . DIRECTORY_SEPARATOR);
    // 模型字段路径
    define('ALIDAYU_PATH', PLUGINS_PATH. 'alidayu' . DIRECTORY_SEPARATOR);
    //TECENT COS
    define('COS_PATH', PLUGINS_PATH. 'qcloudCOS' . DIRECTORY_SEPARATOR);
    //七牛
    define('QINIU_PATH', PLUGINS_PATH. 'Qiniu' . DIRECTORY_SEPARATOR);
    //环信
    define('HUANXIN_PATH', PLUGINS_PATH. 'Emchat' . DIRECTORY_SEPARATOR);
    