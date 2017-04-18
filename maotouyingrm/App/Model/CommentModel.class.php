<?php
/**
 * 评论模型类
 */

namespace Model;
use \Lib\RedisHandler as RedisHandler;

class CommentModel extends BaseModel{
   
    //添加评论
    public function add($data)
    {
        return $this->add($data);
    }
    
    public function getList($condition,$order,$start,$limit)
    {
        $list = $this->where($condition)->order($order)->limit($start,$limit)->select();
        if(empty($list))
        {
            return null;
        }
        $userModel = model('User');
        //获取子集
        foreach ($list as &$value) {
            $userInfo = $userModel->getUserDetail($value['user_id']);
            $value['username'] = $userInfo['username'];
            $value['avator'] = $userInfo['avator'];
            $value['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
            $sonList = $this->where(array('parent_id'=>$value['id']))->order('id desc')->limit(100)->select();
            foreach ($sonList as &$val) {
                $userDetail = $userModel->getUserDetail($val['user_id']);
                $val['username'] = $userDetail['username'];
                $val['avator'] = $userDetail['avator'];
                $val['create_time'] = date('Y-m-d H:i:s',$val['create_time']);
            }
            $value['sonList'] = $sonList;
        }
        return $list;
    }
    
}