<?php

/**
 * Created by PhpStorm.
 * User: ysl
 * Date: 2017/12/25
 * Time: 17:46
 * 描述：登录模型
 */
class indexModel
{
    private $_db = NULL;

    function __construct()
    {
        $db_name = Helper::getConf('PG_DB_DATABASE');
        $this->_db = DB::getInstance($db_name);
    }

    /**
     * 获取用户信息
     * @param $user 用户名
     * @param $pwd 密码
     * @return mixed
     */
    public function getXcInfo($id)
    {

        $sql = "SELECT * FROM xc where uid = $id;";
        return $this->_db->getAll($sql);
    }

    public function showstyle($id)
    {

        $sql = "SELECT * FROM xc where xcid = $id;";
        return $this->_db->getAll($sql);
    }

}