<?php
namespace Home\Controller;
use Home\Controller\BaseController;
class LoanController extends BaseController {
    
    //查询债务人
    public function search()
     {  
        if(!$_REQUEST)
        {
            outPut('0018');
        }
        $this->checkLogin();
        //  echo 123;exit;
        $user_id = $this->LOGIN_USER_ID;
        $username = I('request.username','');//债务人姓名
        $idcard = I('request.idcard','');//债务人身份证
        //echo $username;
        if(empty($idcard) || empty($username))
        {
            outPut('0019');
        }

        //查询是否有此债务人
        $debtorModel = model('Debtor');
        $result = $debtorModel->getInfo($username,$idcard);
        // print_r($result);
        // echo $debtorModel->getlastsql();
       

        // print_r($result);
        if(empty($result))
        {
            $returnback['username'] = $username;
            $returnback['loantimes'] = '0';
            outPut('0000',$returnback);
        }
        $debtor_id = $result['id'];
        //被查询历史记录
        $debtorLogModel = model('DebtorLog');
        $debgor_log_list = $debtorLogModel->getList($debtor_id,$user_id);
        if(!empty($debgor_log_list))
        {
            $key_array = array_column($debgor_log_list, 'search_date');
            $new_debgor_log_list = array_count_values($key_array);
            $i = 0;
            foreach ($new_debgor_log_list as $kk => $vv)
            {
                $new[$i]['sd'] = $kk;
                $new[$i]['sv'] = $vv;
                $i++;
            }
        }
        //历史借款记录
        $inspectModel = model('Inspect');
        $inspect_list = $inspectModel->getlist($debtor_id);
        $userModel = model('User');
        foreach ($inspect_list as &$value) {
            $value['loan'] = round($value['loan']/10000,2).'万';
            $userInfo = $userModel->getInfoByUserId($value['user_id']);
            if(!empty($userInfo))
            {
                $value['creditor_phone'] = $userInfo['phone'];
            }
            else
            {
                $value['creditor_phone'] = '';
            }
        }
        $returnback['debtor_id'] = $debtor_id;
        $returnback['username'] = $result['username'];
        $returnback['searchtimes'] = count($debgor_log_list);
        $returnback['searchlogs'] = $new;
        $returnback['loantimes'] = count($inspect_list);
        $returnback['loanlogs'] = $inspect_list;
        jpush($user_id, array(), C('JIANDU_SEARCH_SUCESS'));
        outPut('0000',$returnback);
    }

    //添加债务监督
    public function add(){
          //echo 123;die;
        //print_r($_REQUEST);
        
         //  $username = $_REQUEST['username'];
         // $idcard = $_REQUEST['idcard'];
         // $status = $_REQUEST['status'];
         // $loan = $_REQUEST['loan'];
         // $pawn = $_REQUEST['pawn'];
         // $loan_date = $_REQUEST['loan_date'];
         // $xuxi_date = $_REQUEST['xuxi_date'];
         // $loan_times = $_REQUEST['loan_times'];
         // $repay_date = $_REQUEST['repay_date'];
         // $extense_date = $_REQUEST['extense_date'];
         // $roleid = $_REQUEST['roleid'];
         // echo $username;die;
        if(!$_REQUEST)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $username = I('post.username','');//债务人姓名
        $idcard = I('post.idcard','');//债务人身份证
        $status = I('post.status',1);//债务状态 1 正常 2坏账 3完结
        $loan = I('post.loan',0);//贷款金额
        $pawn = I('post.pawn',4);//抵押物 1 房产 2车辆 3 无抵押 4其他
        $loan_date = I('post.loan_date','');//借款日期
        $xuxi_date = I('post.xuxi_date','');//续息日
        $loan_times = I('post.loan_times',1);//借款周期
       //$repay_date = I('post.repay_date','');//还款日期
       //$extense_date = I('post.extense_date','');//展期
        $contract_file = I('post.contract_file','');//借款合同
        //echo $user_id;die;
        if(empty($username) || empty($idcard) || empty($loan) || empty($pawn) || empty($loan_date) || empty($user_id))
        {
            outPut('0019');
        }
        if($status != 1 && $status != 2 && $status != 3)
        {
            outPut('0019');
        }
        if($pawn != 1 && $pawn != 2 && $pawn != 3 && $pawn != 4)
        {
            outPut('0019');
        }
        //获取债务人信息
        $debtorModel = model('Debtor');
        $debtorModel->startTrans();
        $debtor_id = $debtorModel->checkIfHasOne($username,$idcard);
        if(empty($debtor_id))//添加失败
        {
            $debtorModel->rollback();
            outPut('0020');
        }
        $data['debtor_id'] = $debtor_id;
        $data['user_id'] = $user_id;
        $data['status'] = $status;
        $data['loan'] = $loan;
        $data['pawn'] = $pawn;
        $data['loan_date'] = $loan_date;
        $replay_date = date('Y-m-d',strtotime($loan_date)+$loan_times*30*86400);
        $data['xuxi_date'] = $xuxi_date;
        $data['loan_times'] = $loan_times;
        //$data['repay_date'] = $replay_date;
        $data['extense_date'] = date('Y-m-d');
        $data['contract_file'] = $contract_file;
        $insert_id = model('Inspect')->add($data);
        echo getlastsql();
        if($insert_id)
        {
            $sysMsgModel = model('Sysmsg');
            $sysmsgData['type'] = 2;
            $sysmsgData['user_id'] = $user_id;
            $sysmsgData['create_time'] = time();
            $sysmsgData['content'] = C('JIANDU_ADD_SUCESS');
            $sysmsgData['obj_id'] = $insert_id;
            $sysMsgModel->insertData($sysmsgData);
            jpush($user_id, array(), C('JIANDU_ADD_SUCESS'));
            $debtorModel->commit();
            outPut('0000');
        }
        $debtorModel->rollback();
        outPut('0020');
    }
    
    //监督业务目录
    public function loanList()
    {
        if(!IS_GET)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $status = I('get.status');//债务状态 1 正常 2坏账 3完结
        $review_status = I('get.review_status');//1 正在审核 2 审核不通过 3审核通过
        $page = I('get.page',1);//页数
        $limit = 20;
        $start = ($page-1)*$limit;
        $inspectModel = model('Inspect');
        if(empty($review_status) && empty($status))
        {
            $status = 1;
        }
        if(!empty($status))
        {
            $condition['status'] = $status;
        }
        if(!empty($review_status))
        {
            $condition['review_status'] = $review_status;
        }
        $condition['user_id'] = $user_id;
        $result = $inspectModel->getListByWhere($condition,$start,$limit);
        if(empty($result))
        {
            outPut('0000');
        }
        $debtorModel = model('Debtor');
        foreach ($result as &$value) {
            $debtorInfo = $debtorModel->getInfoById($value['debtor_id']);
            $value['debtor_name'] = $debtorInfo['username'];
            $value['loan'] = round($value['loan']/10000,2).'万';
        }
        outPut('0000',$result);
    }
    
    //获取监督业务详情
    public function detail()
    {
        if(!IS_GET)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $loan_id = I('get.loan_id');
        $inspectModel = model('Inspect');
//        $userModel = model('User');
        $condition['id'] = $loan_id;
        $condition['user_id'] = $user_id;
        $detail = $inspectModel->getInfo($condition);
        if(empty($detail))
        {
            outPut('0021');
        }
//        $loginUser = $userModel->getUserDetail($user_id);
        $debtorModel = model('Debtor');
        $debtorInfo = $debtorModel->getInfoById($detail['debtor_id']);
        $detail['debtor_name'] = $debtorInfo['username'];
        $detail['debtor_idcard'] = $debtorInfo['idcard'];
//        $detail['invit_username'] = $loginUser['invit_username'];
//        $detail['loan'] = round($detail['loan']/10000,2).'万';
        outPut('0000',$detail);
    }
    //删除监督业务
    public function del()
    {
        if(!IS_POST)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $loan_id = I('post.loan_id');
        $inspectModel = M('Inspect');
        $condition['id'] = $loan_id;
        $condition['user_id'] = $user_id;
        $flag = $inspectModel->where($condition)->delete();
        if($flag)
        {
            $sysMsgModel = model('Sysmsg');
            $sysmsgData['type'] = 2;
            $sysmsgData['user_id'] = $user_id;
            $sysmsgData['create_time'] = time();
            $sysmsgData['content'] = C('JIANDU_DEL_SUCESS');
            $sysmsgData['obj_id'] = $loan_id;
            $sysMsgModel->insertData($sysmsgData);
            jpush($user_id, array(), C('JIANDU_DEL_SUCESS'));
            
            outPut('0000');
        }
        outPut('0038');
    }
    
    //保存监督业务
    public function save()
    {
         if(!IS_POST)
        {
            outPut('0018');
        }
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $loan_id = I('post.loan_id','');//借款id
        $username = I('post.username','');//债务人姓名
        $idcard = I('post.idcard','');//债务人身份证
        $status = I('post.status',1);//债务状态 1 正常 2坏账 3完结
//        $loan = I('post.loan',0);//贷款金额
        $pawn = I('post.pawn',4);//抵押物 1 房产 2车辆 3 无抵押 4其他
        $loan_date = I('post.loan_date','');//借款日期
        $xuxi_date = I('post.xuxi_date','');//续息日
        $loan_times = I('post.loan_times','');//借款周期
        //$repay_date = I('post.repay_date','');//还款日期
        $extense_date = I('post.extense_date','');//展期
        $contract_file = I('post.contract_file','');//借款合同
        //print_r($_REQUEST);exit;
        if(empty($loan_id) || empty($username) || empty($idcard)  || empty($pawn) || empty($loan_date) || empty($user_id))
        {
            outPut('0019');
        }
        if($status != 1 && $status != 2 && $status != 3)
        {
            outPut('0019');
        }
//        if($pawn != 1 && $pawn != 2 && $pawn != 3 && $pawn != 4)
//        {
//            outPut('0019');
//        }
        $loanInfo = M('Inspect')->where(array('id'=>$loan_id))->find();
        if($loanInfo['user_id'] != $user_id)
        {
            outPut('0022');
        }
        //获取债务人信息
        $debtorModel = model('Debtor');
        $debtorModel->startTrans();
        $debtor_id = $debtorModel->checkIfHasOne($username,$idcard);
        if(empty($debtor_id))//添加失败
        {
            $debtorModel->rollback();
            outPut('0038');
        }
//        $data['debtor_id'] = $debtor_id;
//        $data['user_id'] = $user_id;
        $data['status'] = $status;
//        $data['loan'] = $loan;
//        $data['pawn'] = $pawn;
        $data['loan_date'] = $loan_date;
        $data['xuxi_date'] = $xuxi_date;
        $data['loan_times'] = $loan_times;
        //$data['repay_date'] = $repay_date;
        $data['extense_date'] = $extense_date;
//        $data['contract_file'] = $contract_file;
        $flag = M('Inspect')->where(array('id'=>$loan_id))->save($data);

        if($flag)
        {
            $sysMsgModel = model('Sysmsg');
            $sysmsgData['type'] = 2;
            $sysmsgData['user_id'] = $user_id;
            $sysmsgData['create_time'] = time();
            $sysmsgData['content'] = C('JIANDU_SAVE_SUCESS');
            $sysmsgData['obj_id'] = $loan_id;
            $sysMsgModel->insertData($sysmsgData);
            jpush($user_id, array(), C('JIANDU_SAVE_SUCESS'));
            
            $debtorModel->commit();
            outPut('0000');
        }
        $debtorModel->rollback();
        outPut('0020');
    }
    
    //债务人信息
    public function debtorInfo()
    {
        $this->checkLogin();
        $user_id = $this->LOGIN_USER_ID;
        $debtor_id = I('get.debtor_id');
        if(empty($user_id) || empty($debtor_id))
        {
            outPut('0019');
        }
        $debtorModel = model('Debtor');
        $result = $debtorModel->getInfoById($debtor_id);
        //被查询历史记录
        $debtorLogModel = model('DebtorLog');
        $debgor_log_list = $debtorLogModel->getList($debtor_id,$user_id);
        if(!empty($debgor_log_list))
        {
            $key_array = array_column($debgor_log_list, 'search_date');
            $new_debgor_log_list = array_count_values($key_array);
            $i = 0;
            foreach ($new_debgor_log_list as $kk => $vv)
            {
                $new[$i]['sd'] = $kk;
                $new[$i]['sv'] = $vv;
                $i++;
            }
        }
        //历史借款记录
        $inspectModel = model('Inspect');
        $inspect_list = $inspectModel->getlist($debtor_id);
        $userModel = model('User');
        foreach ($inspect_list as &$value) {
            $value['loan'] = round($value['loan']/10000,2).'万';
            $userInfo = $userModel->getInfoByUserId($value['user_id']);
            if(!empty($userInfo))
            {
                $value['creditor_phone'] = $userInfo['phone'];
            }
            else
            {
                $value['creditor_phone'] = '';
            }
        }
        $returnback['debtor_id'] = $debtor_id;
        $returnback['username'] = $result['username'];
        $returnback['searchtimes'] = count($debgor_log_list);
        $returnback['searchlogs'] = $new;
        $returnback['loantimes'] = count($inspect_list);
        $returnback['returnback'] = $inspect_list;
        //print_r($condition);exit;//点击列表进入详情。
        outPut('0000',$returnback);
    }
}