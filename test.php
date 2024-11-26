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
    function all(...$arg)
    {
        $sql = "SELECT * FROM $this->table";

        if (!empty($arg[0])) {  // 使用 $arg 代替 $args
            if (is_array($arg[0])) {
                $where = $this->a2s($arg[0]);
                $sql = $sql . " WHERE " . join(" && ", $where);  // 加上空格
            } else {
                $sql .= $arg[0];
            }
        }

        if (!empty($arg[1])) {
            $sql = $sql . " " . $arg[1];  // 加上空格
        }

        return $this->fetchAll($sql);  // 修正為 fetchAll
    }

    function find($id)
    {
        $sql = "SELECT * FROM $this->table";

        if (is_array($id)) {
            $where = $this->a2s($id);
            $sql = $sql . " WHERE " . join(" && ", $where);  // 加上空格
        } else {
            $sql .= " WHERE `id`='$id'";
        }
        return $this->fetchAll($sql);  // 修正為 fetchAll
    }

    // 把陣列轉成條件字串陣列
    function a2s($array)
    {
        $tmp = [];
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";  // 正確加入條件到數組
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
$dept = $DEPT->all(" ORDER BY `id` DESC");
$dept = $DEPT->find(['code' => '404']);
dd($dept);
