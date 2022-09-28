<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- JQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>    

    
	<title>News blog | Blog</title>
    
</head>
<body>
    
    <style type="text/css">
        #nav{
            margin-top: 2%;
        }
        #home_icon{
        
        }
        #nav_links{
            float: right;
        }
        
        /*********footer**********/
        #footer_content{
            text-align: center;
            padding: 1%;
            margin: 2% auto;
        }
        #footer_content .col-sm-10{
            border-radius: 4px;
            background-color: #222;
            padding: 1%;
            color: #9d9d9d;
        }
    </style>
	<div class="row" id="nav">
		<div class="col-sm-1" ></div>
		<div class="col-sm-10">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header" id="home_icon">
                        <a class="navbar-brand" href="./index.php">
                            <i class="glyphicon glyphicon-home"></i>
                            HOME
                        </a>
                    </div>
                    <div id="nav_links">
                        <ul class="nav navbar-nav">
                            <li><a href="./index.php">HOME</a></li>
                            <li><a href="#">TECHNOLOGY</a></li>
                            <li><a href="#">ABOUT US</a></li>
                            <li><a href="#">CONTACT US</a></li>
                        </ul>
                        <form class="navbar-form navbar-left" action="/search.php">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </form>
                    </div>
                    
                </div>
            </nav> 
        </div>
		<div class="col-sm-1" ></div>
    </div>
    
    <style type="text/css">
        #main_container{
            
        }
        #main_container .blog{
            width: 100%;
            margin-bottom: 4%;
        }
        #main_container .blog .blog{
            width: 80%;
            margin-bottom: 4%;
        }
        #main_container .blog .blog p{
            font-size: 16px;
            margin-left: 1.5%;
        }
        #main_container .blog .blog .container{
            width: 100%;
        }
        #main_container .blog .blog .container .image{
            width: 35%;
            float: left;
        }
        #main_container .blog .blog .container p{
            width: 62%;
            float: left;
            margin-left: 2%;
            font-style: normal;
            text-align: justify;
        }
        #main_container .blog .blog .details{
            width: 100%;
            float: left;
            font-size: 13px;
        }
        #main_container .blog .blog .container .details .comment{
            margin-left: 2%;
        }

        #main_container .comments{
            padding: 1% 2%;
            margin: 1%;
            border-radius: 7px;
        }
        #main_container .comments .other_comments{
            width: 100%;
            float: left;
            padding-left: 2%;
        }
        #main_container .comments .other_comments .heading{

        }
        #main_container .comments .other_comments .comment_div{
            width: 100%;
            float: left;            
            margin-bottom: 15px;
            border-bottom: 1px solid lightgray;
        }
        #main_container .comments .other_comments .comment_div .name{
            font-style: italic;
            margin-bottom: 5px;
        }
        #main_container .comments .other_comments .comment_div .comment{
            margin-bottom: 5px;
        }
        #main_container .comments .my_comment {
            width: 100%;
            float: left;
            padding: 4%;
        }
        #main_container .comments .my_comment .text{
            width: 100%;
            margin-bottom: 1%;
        }
        #main_container .comments .my_comment .text input[type=text]{
            width: 50%;
            border: 1px solid gray;
            border-radius: 7px;
            padding: 2% 3%;
        }
        #main_container .comments .my_comment .text textarea{
            width: 50%;
            height: 150px;
            border: 1px solid gray;
            border-radius: 7px;
            padding: 2% 3%;
        }
        #main_container .comments .my_comment .text input[type=text],
        #main_container .comments .my_comment .text textarea{
            outline: none;   
        }
        .err{color: red;}
    
    </style>
    
    
    <?php
    $blog = (isset($_GET["blog"])) ? $_GET["blog"] : "";        
    $title = $details = $image = $date_posted = $name = $category = "";
    if($blog != ""){
        $sql = "SELECT blog.*, clients.first_name, clients.last_name, clients.role
                FROM (blog 
                    INNER JOIN clients ON blog.posted_by = clients.id) 
                WHERE blog.id = \"$blog\";";
        require("./includes/conn.inc.php");
        $sql_results = new SQL_results();
        $results = $sql_results->results_webhack($sql);
        if ($results->num_rows > 0) {
            $row = $results->fetch_assoc();
            $id = $row['id'];
            $title = $row['title'];
            $details = $row['details'];
            $image = $row['image'];
            $posted_by = $row['posted_by'];
            $date_posted = $row['date_posted'];
            $name = $row['first_name'] . " " . $row['last_name'] . " (" . $row['role'] . ")";
            $trending = ($row["trending"] == 1) ? "Currently trending" : "";
            $category = (($trending != "") ? $trending . " | " : "" ) . $row['category'];

            $sql = "SELECT * 
                    FROM comments 
                    WHERE blog_id = \"$id\"";
            $results = $sql_results->results_webhack($sql);
            $comments = array();
            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()){
                    $temp_comment = array("name"=>$row['name'], "comment"=>$row['message']);
                    array_push($comments, $temp_comment);
                }
            }
            
            ?>
    
            <input type="hidden" id="blog_id" value="<?php echo $blog ?>">
            <div class="row" id="main_container">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="blog">
                        <div class="heading">
                            <h2><strong><?php echo $category;?></strong></h2>
                        </div>
                        <div class="blog">
                            <p><strong><?php echo $title;?></strong></p>
                            <p class="details">
                                <span class="glyphicon glyphicon-time"></span>
                                <i><?php echo $date_posted . " " . $name;?></i>
                            </p>
                            <div class="container">
                                <div class="image">
                                    <a href="blog.php?blog=12345">
                                    </a>
                                        <img src="<?php echo $image; ?>" alt="image" style="width:100%; height: 100%" />
                                </div>
                                <p><?php echo $details; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="comments">
                        <h4 class="heading"><strong>Comments</strong></h4>
                        <div class="other_comments" id="comments">
                            <?php
                            if (sizeof($comments) < 0){
                                foreach($comments as $c => $value){
                                    ?>
                                    <div class="comment_div">
                                        <p class="name"><?php echo $comments[$c]["name"]; ?></p>
                                        <p class="comment"><?php echo $comments[$c]["comment"]; ?> </p>
                                    </div>                                    
                                    <?php
                                }                                    
                            }else{
                                    ?>
                                    <div class="comment_div">
                                        <span style="color: blue">Be the first to comment on this pots<br><br></span>
                                    </div>                                    
                                    <?php                                
                            }
                            ?>
                            
                        </div>
                        <script type="text/javascript">
                            const obj = <?php echo json_encode($_SESSION); ?>;
                        </script>
                        <script type="text/javascript" src="xss/script.js"></script>
                        <div class="my_comment">
                            <div class="text">
                                <input type="text" id="name" onblur="get_name()" placeholder="Your full name">
                                <span class="err" id="err_name" >*</span>
                            </div>
                            <div class="text">
                                <textarea id="comment" onblur="get_comment()" placeholder="Type your comment here"></textarea>
                                <span class="err" id="err_comment" >*</span>
                            </div>
                            <div class="text">
                                <input type="button" id="submit_comment" value="Submit">
                            </div>
                        </div>
                    </div>            
                </div>
                <div class="col-sm-1"></div>
            </div>
        <?php
        }else{
            ?>
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                        <div style="padding: 4% 1%; color: red;">
                            <p>Post not found</p>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
    
            <?php
        }
    }    
    ?>
    
    
    <div class="row" id="footer_content">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="footer">
                <p><strong>News Blog Powered by the Ones-Technology</strong></p>
                <p>Copyright © <?php echo date("Y") ?> | All rights reserved</p>
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>
    
    
    <script type="text/javascript">
        
        $(document).ready(function(){            
            load_comments();
            
            $("#submit_comment").click(function(){
                let name = get_name();
                let message = get_comment();
                let blog = $("#blog_id").val();
                
                console.log("name:" + name);
                console.log("message:" + message);
                if(name == "" || message == ""){
                    return;
                }     
                
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if (this.readyState > 0 || this.readyState < 4){

                    }
                    if (this.readyState == 4 && this.status == 200) {
                        let response_text = this.responseText;
                        console.log(response_text);
                        load_comments();
                        if(response_text == "success"){
                            $("#name").val("");
                            $("#comment").val("");
                        }
                    }
                }
                let url = "./server/comment.php?name=" + name + "&message=" + message + "&id=" + blog;
                xhttp.open("POST", url);
                xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhttp.send("");
            })
                
        });
        
        function load_comments(){
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (this.readyState > 0 || this.readyState < 4){

                }
                if (this.readyState == 4 && this.status == 200) {
                    let response_text = this.responseText;
                    $("#comments").html(response_text);
                }
            }     
            let blog = $("#blog_id").val();
            xhttp.open("GET", "./server/comments.php?blog=" + blog + "&comments=comments", true);
            xhttp.send();            
        }
        
        function get_name(){
            let name = $("#name").val();
            if(name != ""){
                $("#err_name").html("*");
                return name;                
            }else{
                $("#err_name").html("Full name is required");
                return "";
            }
        }
        function get_comment(){
            let name = $("#comment").val();
            if(name != ""){
                $("#err_comment").html("*");
                return name;                
            }else{
                $("#err_comment").html("Message is required");
                return "";
            }
        }
        


    </script>

</body>      
</html>            