<?php


// class DatabaseAccessObject {
//     private $mysql_address = "";
//     private $mysql_username = "";
//     private $mysql_password = "";
//     private $mysql_database = "";
//     private $link;
//     private $last_sql = "";
//     private $last_id = 0;
//     private $last_num_rows = 0;
//     private $error_message = "";

//     /* 建構子 */
//     public function __construct($mysql_address,$mysql_username,
//     $mysql_password,$mysql_database)
//     {
//         $this -> mysql_address = $mysql_address;
//         $this -> mysql_database = $mysql_database;
//         $this -> mysql_password = $mysql_password;
//         $this -> mysql_username = $mysql_username;

//         $this -> link = mysqli_connect($this->mysql_address,
//         $this->mysql_username,$this->mysql_database,$this->mysql_password);

//         if(mysqli_connect_errno()){
//             $this->error_message = "Failed to connect to MySQL: "
//             . mysqli_connect_errno();
//             echo $this->error_message;
//             return false;
//         }

//         mysqli_query($GLOBALS["___mysqli_ston"], "SET NAMES utf8");
//         mysqli_query($this->link,"SET NAMES utf8");
//         mysqli_query($this->link,"SET CHARACTER_SET_CLIENT=utf8");
//         mysqli_query($this->link,"SET CHARACTER_SET_RESULTS=utf8");
//         if(!(bool)mysqli_query($this->link,"USE "
//         .$this->mysql_database)){
//             $this->error_message = 'Database '.$this->mysql_database.'does not exist!';
//         }
//     }

//     /* 解構子 */
//     public function __destruct()
//     {
//         mysqli_close($this->link);
//     }

//     /* 執行SQL語法 */
//     public function execute($sql = null){
//         if($sql==null)return false;

//         $this->last_sql = str_ireplace("DROP","",$sql); // str_ireplace(find,replace,string,count) = 不區分大小寫
//         $result_set = array(); // 最後返回結果

//         $result = mysqli_query($this->link, $this->last_sql); // 執行sql語句

//         if( ((is_object($this->link)) ?  // mysqli_error 若沒錯誤則返回""
//         mysqli_error($this->link) : (($___mysqli_res = mysqli_connect_error()) ?
//         $___mysqli_res:false)) ){

//             $this->error_message = "MySQL ERROR: ".
//             ((is_object($this->link)) ? mysqli_error($this->link) :
//             (($___mysqli_res=mysqli_connect_error()) ? $___mysqli_res : false));

//         }else{

//             $this->last_num_rows = @mysqli_num_rows($result); // 返回結果數量
//             for($xx = 0 ; $xx < @mysqli_num_rows($result) ; $xx++){ //在function前面加@，可不顯示錯誤訊息
//                 $result_set[$xx] = mysqli_fetch_assoc($result);
//             }
//             if(isset($result_set)){ //確認是否有聲明
//                 return $result_set;
//             }else{
//                 $this->error_message = "result: zero";
//             }
//         }

//     }


//     /* 讀取資料庫資料，並回傳陣列 */
//     public function query($table = null , $condition = "1",
//     $order_by = "1", $fields = "*", $limit = ""){

//         $sql = "SELECT {$fields} FROM {$table} WHERE {$condition}
//         ORDER BY {$order_by} {$limit}";

//         return $this->execute($sql);
//     }


//     /* 新增資料-只新增一筆 */
//     public function insert($table = null, $data_array = array()){
//         if($table==null)return false;
//         if(count($data_array)==0)return false;

//         $tmp_col = array();
//         $tmp_dat = array();

//         foreach ($data_array as $key => $value){ // key=索引值
//             $value = mysqli_real_escape_string($this->link,$value); // 轉義，以防無法順利運行
//             $tmp_col[] = $key;
//             $tmp_dat[] = $value;
//         }
//         $columns = join(",",$tmp_col); // 索引值
//         $data = join(",",$tmp_dat); // 資料

//         $this->last_sql = "INSERT INTO ". $table . "(" .
//         $columns . ")VALUES(" . $data . ")";

//         mysqli_query($this->link,$this->last_sql); // 運行sql

//         if (((is_object($this->link)) ?  // mysqli_error 若沒錯誤則返回""
//         mysqli_error($this->link) : (($___mysqli_res = mysqli_connect_error()) ?
//         $___mysqli_res : false))) {

//             $this->error_message = "MySQL Insert Error: " .
//             ((is_object($this->link)) ? mysqli_error($this->link) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false));
//         } else {
//             $this->last_id = mysqli_insert_id($this->link); // 獲取最後新增的id
//             return $this->last_id;
//         }
//     }


//     /* 更新資料 */
//     public function update($table = null,$data_array = null, $key_column = null,
//     $id = null){

//         if($table == null){
//             echo "table is null";
//             return false;
//         }
//         if($id == null) return false;
//         if($key_column == null) return false;
//         if(count($data_array) == 0) return false;

//         $id = mysqli_real_escape_string($this->link,$id);
//         $setting_list = "";
//         foreach($data_array as $key => $value){
//             $value = mysqli_real_escape_string($this->link,$value);
//             $setting_list .= $key . "=" . "\"" . $value ."\""; // 使用轉義符號是為了寫入字串
//             $setting_list .= ",";
//         }
//         $setting_list = substr($setting_list,0,-1);
//         $this->last_sql = "UPDATE " . $table . "SET " . $setting_list
//         . " WHERE " . $key_column . " = " . "\"" . $id . "\""; // 若id設為字串則需要轉義
//         $result = mysqli_query($this->link,$this->last_sql);

//         if (((is_object($this->link)) ? mysqli_error($this->link) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))) {
//             echo "MySQL Update Error: " . ((is_object($this->link)) ? mysqli_error($this->link) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false));
//         } else {
//             return $result;
//         }
//     }


//     /* 刪除資料 */
//     public function delete($table = null, $key_column = null,
//     $id = null){
//         if($table===null)return false;
//         if($id===null)return false;
//         if($key_column===null)return false;

//         return $this->execute("DELETE FROM $table WHERE $key_column = \"$id\" ");
//     }


//     /**
//      * @return string
//      * 回傳執行語法
//      */
//     public function getLastSql(){
//         return $this->last_sql;
//     }

//     /**
//      * @param string $last_sql
//      * 儲存last_sql
//      */
//     public function setLastSql($last_sql){
//         $this->last_sql = $last_sql;
//     }

//     /**
//      * @return int
//      * 回傳新增的ID
//      */
//     public function getLastId(){
//         return $this->last_id;
//     }

//     /**
//      * @param int $last_id
//      * 儲存last_id
//      */
//     public function setLastId($last_id){
//         $this->last_id = $last_id;
//     }

//     /**
//      * @return int
//      *
//      */
//     public function getLastNumRows()
//     {
//         return $this->last_num_rows;
//     }

//     /**
//      * @param int
//      *
//      */
//     public function setLastNumRows($last_num_rows)
//     {
//         $this->last_num_rows = $last_num_rows;
//     }

//     /**
//      * @return string
//      * 回傳物件錯誤訊息
//      */
//     public function getErrorMessage()
//     {
//         return $this->error_message;
//     }

//     /**
//      * @param string
//      * 儲存錯誤訊息
//      */
//     public function setErrorMessage($error_message)
//     {
//         $this->error_message = $error_message;
//     }




// }


$con = require_once('conn.php');
header('Content-type:application/json;charset-utf-8'); // 回傳json格式

if(empty($_POST['content']) ||
   empty($_POST['nickname']) ||
   empty($_POST['site_key'])){
    $json = array(
        "ok" => false,
        "message" => "Please input missing fields"
    );

    $response = json_encode($json); // 轉成json格式
    echo $response;
    die();
}

$site_key = $_POST['site_key'];
$nickname = $_POST['nickname'];
$content = $_POST['content'];
$sql = "insert into discussion(site_key,nickname,content) values ($site_key $nickname $content)";
$sql = "INSERT INTO discussions(site_Key, nickname, content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $site_key, $nickname, $content); //把參數帶上去
$result = $stmt->execute();

if (!$result) {
    $json = array(
        "ok" => false,
        "message" => $conn->error //直接把錯誤訊息給它，但一般來說不會這樣做，因為怕有敏感訊息，不過因為是練習，要知道錯誤在哪裡，所以先這樣做
    );

    $response = json_encode($json);
    echo $response;
    die();
}

$json = array(
    "ok" => true,
    "message" => "success",
);

$response = json_encode($json);
echo $response

?>
