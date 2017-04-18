<?php
namespace Lib;

/**
 *  redis操作类
 *  @author george
 */
class RedisHandler {
    /**
     * @var Redis $redis
     */
    private $redis;
    private static $_instance = array();

    private function __construct($config) {
        if($config == 'REDIS_DEFAULT'){
            $conf['server'] = C('REDIS_HOST');
            $conf['port'] = C('REDIS_PORT');
            $conf['auth'] = C('REDIS_AUTH');
        }else{
            $conf = C($config);
        }
        $this->prefix =  isset($conf['prefix'])?  $conf['prefix']  :   C('REDIS_CACHE_PREFIX'); 
        $this->redis = new \Redis();
        try{
            
            $this->redis->connect($conf['server'], $conf['port']);
            if($conf['auth'])
            {
                $this->redis->auth($conf['auth']);
            }
            $this->redis->ping();
        }catch (Exception $e){
            throw_exception("RedisHandle_redis_connect 3 ".$e->getMessage());
        }
        return $this->redis;
    }

    /**
     * 取得handle对象
     * $config = array(
     *  'server' => '127.0.0.1' 服务器
     *  'port'   => '6379' 端口号
     * )
     * @param string $config
     * @return RedisHandle
     */
    public static function getInstance($config = 'REDIS_DEFAULT') {
        if (!(self::$_instance[$config] instanceof self)) {
            self::$_instance[$config] = new self ($config);
        }
        return self::$_instance[$config];
    }


    /**
     * 设置值(string)会将$value自动转为json格式
     * @param string $key KEY名称
     * @param string|array $value 获取得到的数据
     * @param int $timeOut 时间
     * @return bool
     */
    public function set($key, $value, $timeOut = null) {
        $value = json_encode($value);
        $key   =   $this->prefix.$key;
        
        if(is_int($timeOut) && $timeOut) {
            $retRes = $this->redis->setex($key, $timeOut, $value);
        }else{
            $retRes = $this->redis->set($key, $value);
        }
        
        return $retRes;
    }

    /**
     * 通过KEY获取数据(string),返回array
     * @param string $key KEY名称
     * @return mixed
     */
    public function get($key) {
        $key   =   $this->prefix.$key;
        $result = $this->redis->get($key);
        return json_decode($result, true);
    }

    /**
     * 双重缓存，防止击穿 (如果key没有被初始化，仍有可能会导致击穿现象)
     * @param int  $key    Redis key
     * @return Mix
     */
    public function getByLock($key) {
        $key   =   $this->prefix.$key;
        $sth = $this->redis->get($key);
        if ($sth === false) {
            return $sth;
        } else {
            $sth = json_decode($sth, true);
            if (intval($sth['expire']) <= time()) {
                $lock = $this->redis->incr($key . ".lock");
                if ($lock === 1) {
                    return false;
                }
                return $sth['data'];
            } else {
                return $sth['data'];
            }
        }
    }

    /**
     * 设置Redis，防止缓存击穿
     * @param int  $key    Redis key
     * @param Mix  $value  缓存值
     * @param int  $expire 过期时间
     * @return bool
     */
    public function setByLock($key, $value, $expire=0) {
        $key   =   $this->prefix.$key;
        $expire = intval($expire);
        if ($expire > 0) {
            $r_exp = $expire + 100;
            $c_exp = time() + $expire;
        } else {
            $expire = 300;
            $r_exp = $expire + 100;
            $c_exp = time() + $expire;
        }
        $arg = array("data" => $value, "expire" => $c_exp);
        $rs = $this->redis->setex($key, $r_exp, json_encode($arg, true));
        $this->redis->del($key . ".lock");
        return $rs;
    }

    /**
     * 清空数据
     */
    public function flushAll() {
        return true;
        //return $this->redis->flushAll();
    }

    /**
     * 数据入队列(对应redis的list数据结构)
     * @param string $key KEY名称
     * @param string|array $value 需压入的数据
     * @param bool $right 是否从右边开始入
     * @return int
     */
    public function push($key, $value) {
        $key   =   $this->prefix.$key;
//        $value = json_encode($value);
        return $this->redis->lPush($key, $value);
    }

    /**
     * 数据出队列（对应redis的list数据结构）
     * @param string $key KEY名称
     * @param bool $left 是否从左边开始出数据
     * @return mixed
     */
    public function pop($key) {
        $key   =   $this->prefix.$key;
        $val = $this->redis->rPop($key);
        return $val;
//        return json_decode($val);
    }
    
    public function lleng($key)
    {
        $key   =   $this->prefix.$key;
        $val = $this->redis->lLen($key);
        return $val;
    }

    /**
     * 集合写入数据
     * @param string $name   缓存变量名
     * @param string $value  要插入的值
     * @param string $expire 过期时间
     * @return boolean 是否插入成功
     */
    public function sadd($name,$value,$expire = null)
    {
        //N('cache_write',1);
        $name   =   $this->prefix.$name;
        $result = $this->redis->sAdd($name, $value);
    
//        if($result && $this->options['length']>0) {
//            // 记录缓存队列
//            $this->queue($name);
//        }
        return $result;
    }
    /**
     * 查询集合的值
     * @param unknown $name 缓存变量名
     * @return array $value 集合
     */
    public function members($name)
    {
        //N('cache_read',1);
        $value = $this->redis->sMembers($this->prefix.$name);
        return $value;
    }
    /**
     * 判断一个值是否在集合中
     * @param string $key    缓存变量名
     * @param string $member 要查询的值
     * @return boolean
     */
    public function sismember($key,$member)
    {
        //N('cache_read',1);
        $value = $this->redis->sismember($this->prefix.$key,$member);
        return $value;
    }
     /**
     * 删除一个元素
     * @param string $key    缓存变量名
     * @param string $member 要查询的值
     * @return boolean
     */
    public function rmmember($key,$member)
    {
        //N('cache_read',1);
        $value = $this->redis->srem($this->options['prefix'].$key,$member);
        return $value;
    }
    /**
     * 递增数字
     * @param string $key 缓存变量名
     * @return int $value 值
     */
    public function incrnumber($key)
    {
        //N('cache_read',1);
        $value = $this->redis->incr($this->prefix.$key);
        return $value;
    }
    /**
     * 递增指定数字
     * @param string $key 缓存变量名
     * @return int $value 值
     */
    public function incrbynumber($key,$value=1)
    {
        //N('cache_read',1);
        $result = $this->redis->incrBy($this->prefix.$key,$value);
        return $result;
    }
    /**
     * 设置key过期时间
     * @param string $key 缓存变量名
     * @return int $value 值
     */
    public function setExpire($key,$value=60)
    {
        //N('cache_read',1);
        $value = $this->redis->EXPIRE($this->prefix.$key,$value);
        return $value;
    }
    
    /**
     * 散列赋值
     * 
     * @param string $key
     * @param string $field
     * @param string $value
     */
    public function hset($key,$field,$value)
    {
        //N('cache_read',1);
        $result = $this->redis->HSET($this->prefix.$key,$field,$value);
        return $result;
    }
    
    /**
     * 散列方式获得值
     * 
     * @param string $key
     * @param string $field
     * @return mix 结果集
     */
    public function hget($key,$field)
    {
        //N('cache_read',1);
        $result = $this->redis->HGET($this->prefix.$key,$field);
        return $result;
    }
    /**
     * 散列方式判断字段是否存在
     * 
     * @param string $key
     * @param string $field
     * @return mix 结果集
     */
    public function hexsits($key,$field)
    {
        //N('cache_read',1);
        $result = $this->redis->HEXISTS($this->prefix.$key,$field);
        return $result;
    }
    
    /**
     * 当字段不存在时赋值 如果存在不进行任何操作
     * 
     * @param type $key
     * @param type $field
     * @param type $value
     */
    public function hsetnx($key,$field,$value)
    {
        //N('cache_read',1);
        $result = $this->redis->HSETNX($this->prefix.$key,$field,$value);
        return $result;
    }

    /**
     * 给字段增加数字
     * 
     * @param string $key
     * @param string $field
     * @param int $value
     * @return type
     */
    public function hincrby($key,$field,$value = 1)
    {
        //N('cache_read',1);
        $result = $this->redis->HINCRBY($this->prefix.$key,$field,$value);
        return $result;
    }
    
    /**
     * 删除字段
     * 
     * @param string $key   key
     * @param string $field 字段
     * $return int $result 被删除的个数
     */
    public function hdel($key,$field)
    {
        $result = $this->redis->HDEL($this->prefix.$key,$field);
        return $result;
    }
    
    /**
     * 获得所有集合
     * 
     * @param  string $key
     * @return mix  结果集 
     */
    public function hgetall($key)
    {
        $result = $this->redis->HGETALL($this->prefix.$key);
        return $result;
    }

    /**
     * 删除缓存
     * @access public
     * @param string $name 缓存变量名
     * @return boolean
     */
    public function rm($name) {
        return $this->redis->delete($this->prefix.$name);
    }
    
    /**
     * 透明地调用redis其它操作方法
     *
     * @param string $name
     * @param array $params
     * @return mixed
     */
    public function __call($name, $params) {
        return call_user_method_array($name, $this->redis, $params);
    }
}