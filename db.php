<?php

class DB
{
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db18";
    protected $pdo;
    protected $table;


    function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
    }


    // 撈出全部資料
    // 1.整張資料表
    // 2.有條件
    // 3.其他sql功能
    function all(...$arg)
    {
        $sql = "SELECT * FROM $this->table";
        if (!empty($args[0])) {
            if (is_array($arg[0])) {

                $where = $this->a2s($arg[0]);
                $sql = $sql . "WHERE " . join(" && ", $where);
            } else {
                // $sql =$sql. $arg[0];
                $sql .= $arg[0];
            }
        }
        if (!empty($arg[1])) {
            $sql = $sql . $arg[1];
        }
        return $this->fetchAll($sql);
    }

    function find($id)
    {
        $sql = "SELECT * FROM $this->table";

        if (is_array($id)) {
            $where = $this->a2s($id);
            $sql = $sql . " WHERE " . join(" && ", $where);
        } else {
            // $sql =$sql. $arg[0];
            $sql .= " WHERE `id`='$id'";
        }
        return $this->fetchAll($sql);
    }

    function del($id)
    {
        $sql = "DELETE * FROM $this->table";

        if (is_array($id)) {
            $where = $this->a2s($id);
            $sql = $sql . "WHERE " . join(" && ", $where);
        } else {
            // $sql =$sql. $arg[0];
            $sql .= "WHERE `id`='$id'";
        }
        return $this->pdo->exec($sql);
    }







    // 把陣列轉成條件字串陣列
    function a2s($array)
    {
        $tmp = [];
        foreach ($array as $key => $value) {
            $tmp = "`$key`='$value'";
        }
        return $tmp;
    }


    function fetchOne($sql)
    {
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    function fetchAll($sql)
    {
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}

// function q($sql)
// {
//     return $this->pdo->query($sql)->fetchAll();
// }



function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$DEPT = new DB('dept');
// $dept = $DEPT->q("SELECT * FROM dept");
// $dept = $DEPT->all(['id' => 3]);
$dept = $DEPT->all("Order by `id` DESC");
$dept = $DEPT->find(['code' => '404']);
dd($dept);
