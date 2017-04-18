<?php
/**
 * 监督业务模型类
 */

namespace Model;
class InspectModel extends BaseModel{
    
    /**
     * 根据债务人查询债务信息
     * @param type $debtor_id
     */
    public function getlist($debtor_id='')
    {
        $result = null;
        if(empty($debtor_id))
        {
            return $result;
        }
        $condition['debtor_id'] = $debtor_id;
        $result = $this->field('user_id,debtor_id,loan_date,pawn,loan,status')->where($condition)->select();
        
        return $result;
    }
    /**
     *  查询业务目录
     * @param string $where 查询条件
     * @param string $start 开始地址
     * @param string $limit 查询条数
     * @return type
     */
    public function getListByWhere($where,$start,$limit)
    {
        $result = null;
        if(empty($where))
        {
            return $result;
        }
        $result = $this->field('id,user_id,debtor_id,loan_date,pawn,loan,status,review_status')->where($where)->order('id desc')->limit($start, $limit)->select();
        return $result;
    }
    /**
     * 查询监督业务详情
     * @param  string $condition 条件
     * @return type
     */
    public function getInfo($condition)
    {
        return $this->where($condition)->find();
    }
}