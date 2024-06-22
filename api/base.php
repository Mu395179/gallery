<?php

session_start();

// 建立物件導向
class DB
{
    // 設定一個物件table
    protected $table;

    // 開啟資料庫位置
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=files";

    // 輸入帳密變數
    protected $pdo;

    // 新物件事先執行的程式
    function __construct($table)
    {
        // 建立一個資料表變數
        $this->table = $table;
        // 輸入帳號密碼
        $this->pdo = new PDO($this->dsn, 'root', '');

    }


    // 撈出條件下資料庫所有資料($arg[0],$arg[1])，
    // $arg[0]搜尋條件
    // $arg[1]搜尋後的呈現方式；例如:($arg[0],limit 5)、($arg[0],order by)
    public function all(...$arg)
    {
        // 初始化sql SELECT 語法
        $sql = " SELECT * FROM `$this->table` ";

        // 判斷$arg[0]是否有值
        if (isset($arg[0])) {
            // 判斷$arg[0]是否為陣列
            if (is_array($arg[0])) {
                // 把$arg[0]foreach
                $tmp = $this->a2s($arg[0]);
                // join炸開後 接在where後面
                $sql .= " WHERE " . join(" && ", $tmp);
            } else {
                // 如果不是陣列，就直接接在sql後面
                $sql .= $arg[0];
            }
        }
        // 判斷$arg[1]是否有值
        if (isset($arg[1])) {
            // 直接接在sql後面
            $sql .= $sql[1];
        }
        // 用sql指令呼叫資料庫回傳所有資料
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 呼叫搜尋資料庫回傳單一資料
    public function find($arg)
    {
        // 初始化sql SELECT 語法
        $sql = " SELECT * FROM `$this->table` ";

        // 判斷$arg是否為陣列
        if (is_array($arg)) {
            // 把$arg[0]foreach
            $tmp = $this->a2s($arg);
            // join炸開後 接在where後面
            $sql .= " WHERE " . join(" && ", $tmp);
        } else {
            // 如果不是陣列，就直接接在sql where id後面
            $sql .= " WHERE `id` $arg";
        }
        // 用sql指令呼叫資料庫回傳單一資料
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

    }
    // 新增或更改函式
    public function save($arg)
    {
        // 判斷$arg[id]是否有值
        if (isset($arg['id'])) {
            // 如果有值執行update
            // foreach$arg暫存tmp
            $tmp = $this->a2s($arg);
            // 初始化update sql語法
            $sql = "UPDATE `$this->table` set" . join(" , ", $tmp);
            // 把需更改的條件接在sql後面
            $sql .= " where `id` = '{$arg['id']}'";
        } else {
            // 如果$arg['id']沒有值，執行insert
            $keys = array_keys($arg);
            $sql = "INSERT INTO `$this->table` (`" . join("`,`", $keys) . "`)
                    values(`" . join("`,`", $arg) . "`)";
                    
        }
        // 把更新後的sql回傳資料庫
        return $this->pdo->exec($sql);
    }

    // 刪除函式
    public function del($arg)
    {
        // 初始化sql DELETE 語法
        $sql = " DELETE * FROM `$this->table` ";

        // 判斷$arg是否為陣列
        if (is_array($arg)) {
            // 把$arg[0]foreach
            $tmp = $this->a2s($arg);
            // join炸開後 接在where後面
            $sql .= " WHERE " . join(" && ", $tmp);
        } else {
            // 如果不是陣列，就直接接在sql where id後面
            $sql .= " WHERE `id` $arg";
        }
         // 把更新後的sql回傳資料庫
         return $this->pdo->exec($sql);
    }

    // 陣列foreach暫存tmp 函式
    public function a2s($array)
    {
        $tmp = [];
        foreach ($array as $key => $value) {
            $tmp[] = "`$key` = '$value'";
        }
        return $tmp;
    }

}

// PHP超連結函式
function to($url)
{
    header("location:" . $url);
}

// 顯示檢查 函式
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}




