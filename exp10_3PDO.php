<?php
class exp10_3PDO
{
    private $db = null;
    private function getConn()
    {
        if ($this->db === null) {
            $dsn = "mysql:host=127.0.0.1;dbname=web_exp6";
            $option = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"];
            $this->db = new PDO($dsn, 'root', '123456', $option);
        }
        return $this->db;
    }
    public function execSQL($sql)
    {
        $this->getConn();
        return $this->db->exec($sql);
    }
    public function query($sql)
    {
        $this->getConn();
        return $this->db->query($sql);
    }
}
