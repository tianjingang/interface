<?php
	namespace Think\Session\Driver;
	class Redis {
		private $redis;
		private $lifeTime;
		/**
		* 打开Session 
		* @access public 
		* @param string $savePath 
		* @param mixed $sessName  
		*/
		public function open($savePath, $sessName){
			$this->lifeTime = C('SESSION_EXPIRE')?C('SESSION_EXPIRE'):ini_get('session.gc_maxlifetime');
			$this->redis = new \Redis;
			$this->redis->connect(C('REDIS_HOST'),C('REDIS_PORT'));
			$this->redis->auth(C('REDIS_AUTH'));
			return $this->redis;
		}
		/**
		* 关闭Session 
		* @access public 
		*/
		public function close(){
			return $this->redis->close();
		}
		/**
		* 读取Session 
		* @access public 
		* @param string $sessID 
		*/
		public function read($sessID){
			$id = C('SESSION_PREFIX').$sessID;
			$data = $this->redis->get($id);
			return $data?$data:'';
		}
		/**
		* 写入Session 
		* @access public 
		* @param string $sessID 
		* @param String $sessData  
		*/
		public function write($sessID,$sessData){
			$id = C('SESSION_PREFIX').$sessID;
			return $this->redis->set($id,$sessData,$this->lifeTime);
		}
		/**
		* 删除Session 
		* @access public 
		* @param string $sessID 
		*/
		public function destroy($sessID){
			$id = C('SESSION_PREFIX').$sessID;
			return $this->redis->delete($id);
		}
		/**
		* Session 垃圾回收
		* @access public 
		* @param string $sessMaxLifeTime 
		*/
		public function gc($sessMaxLifeTime){
			return true;
		}
		/**
		* 打开Session 
		* @access public 
		*/
		public function execute() {
		session_set_save_handler(array(&$this,"open"), 
								 array(&$this,"close"), 
								 array(&$this,"read"), 
								 array(&$this,"write"), 
								 array(&$this,"destroy"), 
								 array(&$this,"gc")); 
		}
	}
?>