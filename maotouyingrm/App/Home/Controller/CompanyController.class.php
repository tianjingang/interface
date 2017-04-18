<?php

namespace Home\Controller;
use Home\Controller\BaseController;
class CompanyController extends BaseController {
    
    //添加员工
    public function addEmployee()
    {
        if(!IS_POST)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
//        $username = I('post.username');//员工用户名
//        $password = I('post.password');//密码
        $phone = I('post.phone');//手机号
//        $avator = I('post.avator');//用户头像
         //验证必填项是否为空
        if(empty($phone) )
        {
            outPut('0019');
        }
       
        //验证手机格式是否正确
        $flag = check_phone($phone);
        $flag == false && outPut('0001');
//        
        //查看该手机是否已经注册
        $userModel = model('User');
         //查看该用户是否是企业
        $loginUser = $userModel->getUserDetail($user_id);
        if($loginUser['roleid'] == 1)
        {
            outPut('0045');
        }
        $user_info = $userModel->getInfoByPhone($phone);
        if(empty($user_info))
        {
            outPut('0002');
        }
        
        $userModel->startTrans();
//        $passsalt = randCode(5);
//        $password = md5($password.$passsalt);
//        $data['phone'] = $phone;
//        $data['password'] = $password;
//        $data['passwordalt'] = $passsalt;
//        $data['username'] = $username;
////        $data['idcard'] = $idcard;
//        $data['position'] = 0;
//        $data['reg_invitecode'] = '';
//        $data['avator'] = $avator;
//        $data['create_time'] = time();
//        $insert_id = $userModel->add($data);
//        if($insert_id)
//        {
        $insert_id = $user_info['id'];
        $emp_where['employer_user_id'] = $user_id;
           $emp_where['employee_user_id'] = $insert_id;
           $emp_resu = M('employee')->where($emp_where)->select();
           if($emp_resu)
           {
               outPut('0049');
           }
           //添加关系到员工表
           
           $emp_data['employer_user_id'] = $user_id;
           $emp_data['employee_user_id'] = $insert_id;
           $emp_flag = M('employee')->add($emp_data);
           if($emp_flag)
           {
               $userModel->commit();
               //注册到环信中
//                $add_flag = $this->huanxinAdd($phone, $username);
//                if($add_flag)
//                {
                    //两者添加为好友
                    $this->huanxinAddFriend($loginUser['phone'], $phone);
//                }
//                else
//                {
//                    //记录到数据库中 以后同步
//                    $huanxin_data['user_id'] = $user_id;
//                    $huanxin_data['create_time'] = time();
//                    M('huanxin_log')->add($huanxin_data);
//                }
                outPut('0000');
           }
           
//        }
        $userModel->rollback();
        outPut('0038');
    }
    //删除员工
    public function delEmployee()
    {
        if(!IS_POST)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $employee_user_id = I('post.employee_user_id');
        if(empty($user_id) || empty($employee_user_id))
        {
            outPut('0019');
        }
        if($user_id == $employee_user_id)
        {
            outPut('0051');
        }
        //查看该用户是否是企业
        $userModel = model('User');
        $loginUser = $userModel->getUserDetail($user_id);
        $empUser = $userModel->getUserDetail($employee_user_id);
        if($loginUser['roleid'] == 1)
        {
            outPut('0045');
        }
        $employModel = M('employee');
        $insModel = model('Inspect');
        //查询关系是否存在
        $e_cond['employer_user_id'] = $user_id;
        $e_cond['employee_user_id'] = $employee_user_id;
        $result = $employModel->where($e_cond)->find();
        if(empty($result))
        {
            outPut('0048');
        }
        $employModel->startTrans();
        $del_flag = $employModel->where(array('id'=>$result['id']))->delete();
        
        if($del_flag)
        {
            //删除成功后把之前员工的债务人移到创始人
            $has = $insModel->where(array('user_id'=>$employee_user_id))->find();
            if(empty($has))
            {
                $employModel->commit();
                $this->huanxinDelFriend($loginUser['phone'], $empUser['phone']);
                outPut('0000');
            }
            else
            {
                $insData['user_id'] = $user_id;
                $insWhere['user_id'] = $employee_user_id;
                $insFlag = $insModel->where($insWhere)->save($insData);
                if($insFlag)
                {
                    $employModel->commit();
                    $this->huanxinDelFriend($loginUser['phone'], $empUser['phone']);
                    outPut('0000');
                }
                else
                {
                    $employModel->rollback();
                    outPut('0038');
                }
            }
        }
        else
        {
            $employModel->rollback();
            outPut('0038');
        }
    }
    
    
    public function empList()
    {
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $employModel = M('employee');
        $userModel = model('User');
        $condition['employer_user_id'] = $user_id;
        $list = $employModel->where($condition)->select();
        if(empty($list))
        {
            outPut('0000');
        }
        $empids = array_column($list, 'employee_user_id');
        $where['id'] = array('in',$empids);
        $userList = $userModel->field('id,username,avator')->where($where)->select();
        foreach ($userList as &$value) {
           $value['avator'] = C('FILE_URL').$value['avator'];
           if(empty($value['username']))
           {
               $value['username'] = $value['phone'];
           }
        }
        outPut('0000',$userList);
    }
    
}