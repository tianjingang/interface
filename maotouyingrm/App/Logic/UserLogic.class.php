<?php


namespace Logic;
use Lib\Log;

/**
* 站点Logic
*/
class UserLogic extends BaseLogic {

    public function addUser($data) {
        M()->startTrans();
        $data['password'] = md5($data['pwd']);
        $user_id = model('AdminUser')->add($data);
        if ($user_id) {
            $role_user_data = array(
                'role_id' => $data['role_id'],
                'user_id' => $user_id,
                );
            if(model('role_user')->add($role_user_data)) {
                M()->commit();
                return true;
            } else {
                M()->rollback();
                return false;
            }
        } else {
            M()->rollback();
            return false;
        }
    }

    public function delete($userid) {
        M()->startTrans();
        $user_model = model('AdminUser');
        if ($user_model->where(array('id' => $userid))->delete()) {
            if(model('role_user')->where(array('user_id' => $userid))->delete()) {
                M()->commit();
                return true;
            } else {
                M()->rollback();
                return false;
            }
        } else {
            M()->rollback();
            return false;
        }
    }

}