<?php
class exp7_4_mydb
{
    private $db = null; //数据库连接
    private function getConn()
    {
        if ($this->db === null) {
            $this->db = new mysqli('localhost', 'root', '123456') or die('不能打开连接:');
            $this->db->query('SET NAMES "UTF8"');
            $this->db->select_db('web_exp6') or die('数据库不能打开');
        }
        return $this->db;
    }
    public function execSQL($sql)
    { //获取查询记录集
        $this->getConn();
        return $this->db->query($sql);
    }
    public function getAffectedRows()
    { //获取查询结果数
        return $this->getConn()->affected_rows;
    }
    public function __destruct()//析构函数
    {
        if ($this->db !== null) {
            $this->db->close();
        }
    }
}
