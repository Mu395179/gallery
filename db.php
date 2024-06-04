<?php
// 連接資料庫的變數
$dsn = "mysql:host=localhost;charset=utbf8;dbname=file";
// 登入帳號密碼
$pdo = new PDO($dsn,'root','');

function all($table, $where)
{   
    // global 外部連結變數
    global $pdo;
    // 初始化sql語法
    $sql = "SELECT * FROM `{$table}` {$where}";
    // 用通用陣列的方式呼叫sql，並且是所有資料
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    // function 結束函式，並將函式所得出的結果回傳給$rows
    return $rows;
}

function find($table, $arg)
{
    // 初始化sql語法
    $sql= "SELECT * FROM `{$table}` WHERE";
    // 判斷WHERE條件是否為陣列
    if(is_array($arg)){
        // 如果是陣列，則把sql陣列foreach後存進$tmp
        $tmp = array2sql($arg);
        // 把 $tmp 暫存的條件陣列轉成字串用&&串起來接在WHERE後面
        $sql .= join("&&",$tmp);

    }else{
        // 如果搜尋ID就直接帶入sql語法WHERE後面
        $sql .="`id`='{$arg}'";
    }

}

function save($table, $array)
{
    // 判斷陣列中是否有[id] 項目
    if(isset($array['id'])){
        // 如果有代表資料庫已經有資料，就是更新資料庫資料
        update($table, $array, $array['id']);
    }else{
        // 如果沒有就是新增資料庫資料
        insert($table, $array);
    }
}

/**
 * 更新資料表中的資料
 * @param string $table 資料表名稱
 * @param array $cols 欄位名稱和對應的值
 * @param mixed $arg 條件參數，可以是陣列或單一值
 * @return int 返回受影響的行數
 */

 function update($table,$cols, $arg)
{
    global $pdo;
    // 初始化sql語法
    $sql = "UPDATE `{$table}` SET ";
    // 使用迴圈將要更新的欄位名稱和值組合成字串
    $tmp = array2sql($cols);

    $sql .=join(",", $tmp);

    // 判斷更改的對象是否為陣列
    if(is_array($arg)){
        // 如果是陣列就用迴圈把欄位名稱陣列化存到$tt
        $tt = array2sql($arg);
        // 把暫存的$tt字串化，用&& 皆在sql WHERE後面
        $sql .= "WHERE" . join("&&",$tt);
    }else{
        // 如果條件為id，就直接接在WHERE後面
        $sql .= "WHERE `id`='{$arg}'";
    }
    echo $sql;

    // 把更新號的資料存到資料庫中
    return $pdo ->exec($sql);
}

function insert($table, $cols)
{
    // sql的新增語法:
    // INSERT INTO `$table(資料庫名稱)` 新增項目$cols的key(`name`,`email`) VALUES 項目的值$cols的values('John','john@example.com')
    global $pdo;
    // sql初始化
    $sql = "INSERT INTO `{$table}`";
    // 從新增的陣列中提取key的部分，接在資料庫名稱的後面
    $sql .= "(`" . join("`,`", array_keys($cols)) . "`)";
    // 從新增的陣列中提取value的部分，接在語法中VALUES後面
    $sql .=" VALUES('" . join("','",$cols) . "')";
    // 把新增資料回傳給資料庫
    return $pdo->exec($sql);
}

function del($table,$arg)
{
    global $pdo;
    // 初始化sql語法
    $sql = "DELETE FROM `{$table}` WHERE ";
    // 判斷條件式是否為陣列
    if(is_array($arg)){
        // 把條件式項目暫存在$tmp
        $tmp = array2sql($arg);
        // 把陣列變成字串，接在WHERE
        $sql .=join("&&",$tmp);
        // 如果不是陣列，就直接接在WHERE後面
    }else{
        $sql .=" `id`='{$arg}'";
    }
    // 把刪除資料回傳給資料庫
    return $pdo->exec($sql);
}



// array to sql
function array2sql($array)
{
    // sql命令陣列用foreach的方式存進tmp[]
    foreach($array as $key=>$value){
        $tmp[] = "`$key`='$value'";
    }

    return $tmp;
}

function q($sql)
{
    global $pdo;
    // 呼叫$sql全部的資料
    return $pdo->query($sql)->fetchAll();
}

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
