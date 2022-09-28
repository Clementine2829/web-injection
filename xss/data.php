<?php
    $browser_details = $_SERVER['HTTP_USER_AGENT'];

    $data = clean_data($_REQUEST['data']) . ":::Browser: " . $browser_details;


    $id = password_hash(0, PASSWORD_DEFAULT);
    $id = substr($id,7,20);
    while(!preg_match("/^[a-zA-Z0-9]*$/", $id)) {
        $id = password_hash($id, PASSWORD_DEFAULT);
        $id = substr($id,7,20);
    }        

    require("../includes/conn.inc.php");
    $sql = "INSERT INTO xss_injection(id, data) VALUES (\"$id\",\"$data\")";
    $db_login = new DB_login_updates();
    $connection = $db_login->connect_db("injections");
    if ($connection->query($sql)) {

    }
    $connection->close();

    function clean_data($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;        
    }
?>