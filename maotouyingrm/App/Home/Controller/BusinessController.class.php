<?php
namespace Home\Controller;
use Home\Controller\BaseController;
use \Lib\RedisHandler as RedisHandler;
class BusinessController extends BaseController {
    
    //添加商务合作
    public function add()
    {
        if(!IS_POST)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        
        $pic = I('post.pic','');//配图
        $title = I('post.title','');//标题
        $content = I('post.content','');//内容
        if(empty($title) || empty($title) || empty($content))
        {
            outPut('0019');
        }
        //60秒冷却
        $reids_handle = RedisHandler::getInstance();
        $add_limit = $reids_handle->get(C('BUSINESS_CACHE').$user_id);
        if($add_limit == 1)
        {
            outPut('0040');
        }
        $reids_handle->set(C('BUSINESS_CACHE').$user_id,1,60);
        $data['user_id'] = $user_id;
        $data['title'] = $title;
        $data['pic'] = $pic;
        $data['content'] = $content;
        $data['create_date'] = date('Y-m-d');
        $flag = M('business')->add($data);
        if($flag)
        {
            $sysMsgModel = model('Sysmsg');
            $sysmsgData['type'] = 3;
            $sysmsgData['user_id'] = $user_id;
            $sysmsgData['create_time'] = time();
            $sysmsgData['content'] = C('BUSINESS_ADD_SUCESS');
            $sysmsgData['obj_id'] = $flag;
            $sysMsgModel->insertData($sysmsgData);
            jpush($user_id, array(), C('BUSINESS_ADD_SUCESS'));
            outPut('0000');
        }
        else {
            outPut('0020');
        }
    }
    
    //商务合作列表
    public function getList()
    {
        $page = I('get.page',1);
        $limit = 20;
        $start = ($page - 1)*$limit;
        $businessModel = M('business');
      
        if($page == 1)
        {
            //获取状态为火的商务列表
            $hot_condition['status'] = 2;
            $hot_list = $businessModel->where($hot_condition)->select();
        }
        $order = 'id desc';
        $normal_condition['status'] = 1;
        //获取其他的商务列表
        $normal_list = $businessModel->where($normal_condition)->order($order)->limit($start,$limit)->select();
        if(empty($hot_list) && empty($normal_list))
        {
            outPut('0000');
        }elseif(empty ($hot_list) && !empty ($normal_list))
        {
            $list = $normal_list;
        }elseif(!empty ($hot_list) && empty ($normal_list))
        {
            $list = $hot_list;
        }else{
            $list = array_merge($hot_list,$normal_list);
        }
        $userModel = model('User');
        foreach ($list as &$value) {
            $userInfo = $userModel->getUserDetail($value['user_id']);
            $value['username'] = $userInfo['username'];
            $value['avator'] = $userInfo['avator'];
            $value['phone'] = $userInfo['phone'];
        }
        outPut('0000',$list);
    }
    
    //删除商务合作
    public function del()
    {
        if(!IS_POST)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $id = I('post.id','');//商务合作id
        if(empty($user_id) || empty($id))
        {
            outPut('0019');
        }
        $condition['id'] = $id;
        $condition['user_id'] = $user_id;
        $flag = M('business')->where($condition)->delete();
        if($flag)
        {
            $sysMsgModel = model('Sysmsg');
            $sysmsgData['type'] = 3;
            $sysmsgData['user_id'] = $user_id;
            $sysmsgData['create_time'] = time();
            $sysmsgData['content'] = C('BUSINESS_DEL_SUCESS');
            $sysmsgData['obj_id'] = $flag;
            $sysMsgModel->insertData($sysmsgData);
            jpush($user_id, array(), C('BUSINESS_DEL_SUCESS'));
            
            outPut('0000');
        }
        outPut('0038');
    }
    
    //我发布
    public function myList()
    {
        if(!IS_GET)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $page = I('get.page',1);
        $limit = 20;
        $start = ($page - 1)*$limit;
        $businessModel = M('business');
      
        if($page == 1)
        {
            //获取状态为火的商务列表
            $hot_condition['user_id'] = $user_id;
            $hot_condition['status'] = 2;
            $hot_list = $businessModel->where($hot_condition)->select();
        }
        $order = 'id desc';
        $normal_condition['user_id'] = $user_id;
        $normal_condition['status'] = 1;
        //获取其他的商务列表
        $normal_list = $businessModel->where($normal_condition)->order($order)->limit($start,$limit)->select();
        if(empty($hot_list) && empty($normal_list))
        {
            outPut('0000');
        }elseif(empty ($hot_list) && !empty ($normal_list))
        {
            $list = $normal_list;
        }elseif(!empty ($hot_list) && empty ($normal_list))
        {
            $list = $hot_list;
        }else{
            $list = array_merge($hot_list,$normal_list);
        }
        $userModel = model('User');
        foreach ($list as &$value) {
            $userInfo = $userModel->getUserDetail($value['user_id']);
            $value['username'] = $userInfo['username'];
            $value['avator'] = $userInfo['avator'];
            $value['phone'] = $userInfo['phone'];
        }
        outPut('0000',$list);
    }
    
    //合作详情
    public function detail()
    {
        $id = I('get.id','');
        if(empty($id))
        {
            outPut('0000');
        }
        $businessModel = M('business');
        $detail = $businessModel->where(array('id'=>$id))->find();
        if(empty($detail))
        {
            outPut('0000');
        }
        $userModel = model('User');
        $userInfo = $userModel->getUserDetail($detail['user_id']);
        $detail['username'] = $userInfo['username'];
        $detail['avator'] = $userInfo['avator'];
        $detail['phone'] = $userInfo['phone'];
        
        //查询评论
        $commentModel = model('Comment');
        $condition['obj_id'] = $id;
        $condition['parent_id'] = 0;
        $order = 'id desc';
        $start = 0;
        $limit = 40;
        $commentList = $commentModel->getList($condition,$order,$start,$limit);
        $comment_nums = $commentModel->where($condition)->count();
        $detail['comment_list'] = $commentList;
        $detail['comment_nums'] = $comment_nums;
        outPut('0000',$detail);
    }
}