<?php session_start();
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        
    } else if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_REQUEST['blog']) && isset($_REQUEST["comments"])){
            $blog = $_REQUEST['blog'];
            $sql = "SELECT * 
                    FROM comments 
                    WHERE blog_id = \"$blog\"";
            require("../includes/conn.inc.php");
            $sql_results = new SQL_results();
            $results = $sql_results->results_webhack($sql);
            $comments = array();
            $div = "";
            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()){
                    $temp_comment = array("name"=>$row['name'], "comment"=>$row['message']);
                    array_push($comments, $temp_comment);
                }
            }
            if (sizeof($comments) > 0){
                foreach($comments as $c => $value){
                    $div .= '<div class="comment_div">
                                <p class="name">' . $comments[$c]["name"] . '</p>
                                <p class="comment">' . $comments[$c]["comment"] . '</p>
                            </div>';
                }                                    
            }else{
                $div .= '<div class="comment_div">
                        <span style="color: blue">Be the first to comment on this pots<br><br></span>
                    </div> ';                          
            }
            echo $div;
        } else echo "Invalid request method";
    } 

return;

?>


    <div class="comment_div">
        <p class="name">Clementine</p>
        <p class="comment">This is very insightfull. Thanks </p>
    </div>
    <div class="comment_div">
        <p class="name">John Doe</p>
        <p class="comment">I do not agree with this at all.  </p>
    </div>
    <div class="comment_div">
        <p class="name">Ashly</p>
        <p class="comment">The goverment should do something about this. This is not acceptable at all. we cannot live like this with our things diying </p>
    </div>
