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

    
	<title>News blog | home</title>
    
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
                        <a class="navbar-brand" href="#">
                            <i class="glyphicon glyphicon-home"></i>
                            HOME
                        </a>
                    </div>
                    <div id="nav_links">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Home</a></li>
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
            <?php 
                if(isset($_SESSION['s_name'])){
                    echo '<span>Hi, ' . $_SESSION['s_name'] . '<br><br></span>';
                }            
//                    foreach ($_SESSION as $key=>$val)
//                        echo $key." ".$val."<br/>";
            ?>
        </div>
		<div class="col-sm-1" ></div>
    </div>
    
    <style type="text/css">
        #main_container{
            
        }
        #main_container .treding,
        #main_container .technology{
            
        }
        #main_container .treding,
        #main_container .technology{
            width: 100%;
            margin-bottom: 4%;
        }
        #main_container .treding .heading,
        #main_container .technology .heading{
            display: none;
        }
        #main_container .treding .heading:nth-child(1),
        #main_container .technology .heading:nth-child(1){
            display: inline-block;
        }
        #main_container .treding .blog,
        #main_container .technology .blog{
            width: 80%;
            margin-bottom: 4%;
        }
        #main_container .treding .blog p,
        #main_container .technology .blog p{
            font-size: 16px;
            margin-left: 1.5%;
        }
        #main_container .treding .blog .container,
        #main_container .technology .blog .container{
            width: 100%;
        }
        #main_container .treding .blog .container .image,
        #main_container .technology .blog .container .image{
            width: 35%;
            float: left;
        }
        #main_container .treding .blog .container p,
        #main_container .technology .blog .container p{
            width: 62%;
            float: left;
            margin-left: 2%;
            font-style: normal
        }
        #main_container .treding .blog .container .details,
        #main_container .technology .blog .container .details{
            width: 100%;
            float: left;
            font-size: 13px;
        }
        #main_container .treding .blog .container .details .comment,
        #main_container .technology .blog .container .details .comment{
            margin-left: 2%;
        }
    
    </style>
    
    <div class="row" id="main_container">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="treding" id="trending">
            </div>
            <div class="technology" id="technology">
            </div>            
        </div>
        <div class="col-sm-1"></div>
    </div>
    

    
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
            get_trending_news();
            get_other_news();

        });
        
        function get_trending_news(){
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (this.readyState > 0 || this.readyState < 4){
                    $("#trening").html("Loading...Please wait");
                }
                if (this.readyState == 4 && this.status == 200) {
                    let response_text = this.responseText;
                    $("#trending").html(response_text);
                }
            }     
            let blog = $("#blog_id").val();
            xhttp.open("GET", "./server/home-blogs.php?trending=true", true);
            xhttp.send();            
        }
        function get_other_news(){
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (this.readyState > 0 || this.readyState < 4){
                    $("#technology").html("Loading...Please wait");
                }
                if (this.readyState == 4 && this.status == 200) {
                    let response_text = this.responseText;
                    $("#technology").html(response_text);
                }
            }     
            let blog = $("#blog_id").val();
            xhttp.open("GET", "./server/home-blogs.php?technology=true", true);
            xhttp.send();            
        }
    </script>

</body>      
</html>