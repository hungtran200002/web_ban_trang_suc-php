<?php
class Db{
    protected static $connection;

    //hamkhoittao ket noi
    public function connect(){
        //ket noloi db trong truong hop kn chua ktao
        if(!isset(self::$connection)){
            //lay thong tin ket noi tu tep config.ini
            $config = parse_ini_file("config.ini");
            self::$connection = new mysqli("localhost",$config["username"], $config["password"], $config["databasename"]);

        }
        //xu li loi neu ko ket noi ddc csdl
        if(self::$connection==false){
            return false;
        }
        return self::$connection;
    }
    //ham thuc hien xu ly cau lenh truy van
    public function query_execute($queryString){
        //khoi tao kn
        $connection = $this->connect();
        //thuc hien execute truy van
        $connection->query("SET NAMES utf8");
        $result = $connection->query($queryString);
        // $connection->close();
        return $result;
    }

    //Ham thuc hien tra ve mot danh sach ket qua
    public function select_to_array($queryString){
        $rows = array();
        $result = $this->query_execute($queryString);
        if($result==false) return false;

        while($item = $result->fetch_assoc()){
            $rows[] = $item;
        }
        return $rows;
    }
}
?>