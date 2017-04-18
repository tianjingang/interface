<?php
namespace Home\Controller;
use Home\Controller\BaseController;
use \Lib\RedisHandler as RedisHandler;
class CommentController extends BaseController {
    
    //添加评论
    public function add()
    {
        if(!IS_POST)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $content = I('post.content','');
        $obj_id = I('post.obj_id','');
        $parent_id = I('post.parent_id',0);
        if(empty($content) || empty($obj_id))
        {
            outPut('0019');
        }
        $commentModel = M('Comment');
        $data['content'] = $content;
        $data['user_id'] = $user_id;
        $data['create_time'] = time();
        $data['parent_id'] = $parent_id;
        $data['obj_id'] = $obj_id;
        $flag = $commentModel->add($data);
       
        if($flag)
        {
            outPut('0000');
        }
        else
        {
            outPut('0038');
        }
    }
    
    //评论列表
    public function getList()
    {
        if(!IS_GET)
        {
            outPut('0018');
        }
        $page = I('get.page',1);//第几页
        $obj_id = I('get.obj_id');//对象id
        if(empty($obj_id))
        {
            outPut('0000');
        }
        $limit = 10;
        $start = ($page -1)*$limit;
        $order = 'id desc';
        $commentModel = model('Comment');
        $condition['obj_id'] = $obj_id;
        $condition['parent_id'] = 0;
        $list = $commentModel->getList($condition,$order,$start,$limit);
        $comment_nums = $commentModel->where($condition)->count();
        $result['comment_list'] = $list;
        $result['comment_nums'] = $comment_nums;
        outPut('0000',$result);
    }
    
    //删除评论
    public function del()
    {
        if(!IS_POST)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $comment_id = I('post.comment_id');//评论id
        if(empty($user_id) || empty($comment_id))
        {
            outPut('0019');
        }
        $condition['id'] = $comment_id;
        $condition['user_id'] = $user_id;
        $flag = M('comment')->where($condition)->delete();
        if($flag)
        {
            outPut('0000');
        }
        outPut('0038');
    }
}