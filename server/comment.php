<?php session_start(); 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user_id = (isset($_SESSION['s_id'])) ? $_SESSION['s_id'] : "";
//        $user_id = "sBIGxZHYTAchyEffGgiHUOD6zMLP09BUy0A";
        $name = (isset($_REQUEST['name'])) ? $_REQUEST['name'] : "";
        $message = (isset($_REQUEST['message'])) ? $_REQUEST['message'] : "";
        $id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : "";

        if($user_id == ""){
            echo json_encode(array("status"=>"failed", "message"=>"Coul not validate user. Make sure you are logged in"));
            return;
        }
        
        $commend_id = password_hash(0, PASSWORD_DEFAULT);
        $commend_id = substr($commend_id,7,15);
        while(!preg_match("/^[a-zA-Z0-9]*$/", $commend_id)) {
            $commend_id = password_hash($commend_id, PASSWORD_DEFAULT);
            $commend_id = substr($commend_id,7,15);
        }        
        
        require("../includes/conn.inc.php");
        $date = date("d-M-Y h:i");
        $sql = "INSERT INTO comments VALUES (\"$commend_id\", \"$id\", \"$message\", \"$user_id\", \"$name\", \"$date\")";
        $db_login = new DB_login_updates();
        $connection = $db_login->connect_db("webhack");
        if ($connection->query($sql)) {
            // do nothing actually 
            echo "success";
        }
        $connection->close();
        
    }else echo json_encode(array("status"=>"failed", "message"=>"Invalid request method"));

?>