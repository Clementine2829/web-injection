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
                        <a class="navbar-brand" href="index.php">
                            <i class="glyphicon glyphicon-home"></i>
                            HOME
                        </a>
                    </div>
                    <div id="nav_links">
                        <ul class="nav navbar-nav">
                            <li><a href="index.php">Home</a></li>
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
        #login_container{
            width: 100%;
            margin: 5% auto;
        }
        #login_container .login{
            margin: auto 5%;
            width: 100%;
        }
        #login_container .login .container{
            width: 80%;
            padding: 1%;
        }
        #login_container .login .container input{
            border: 1ps solid gray;
            outline: none;
            border-radius: 5px;
            padding: 1% 3%;
            width: 35%;
        }
    
    </style>
    <?php
        $username = $password = $err_msg = "";
        if($_SERVER['REQUEST_METHOD']=="POST"){
			$usernameLower = strtolower($_POST["username"]);
			if (empty($usernameLower) || empty($_POST["password"])) {
				$err_msg = "Invalid username or password";	
			} else {
				$username = $usernameLower; 
				$password = $_POST["password"];
			}
            
            $sql = "SELECT * FROM clients WHERE email = \"$username\" AND password = \"$password\" LIMIT 1";
            require("./includes/conn.inc.php");
            $sql_results = new SQL_results();
            $results = $sql_results->results_webhack($sql);
            if ($results->num_rows > 0) {
                $row = $results->fetch_assoc();
                $_SESSION['s_id'] = $row['id'];
                $_SESSION['s_name'] = $row['first_name'] . " " . $row['last_name'];
                $_SESSION['s_email'] = $row['email'];
                $_SESSION['s_role'] = $row['role'];
                ?>
                    <script type="text/javascript">
                        window.location = "./index.php";
                    </script>
                <?php
            }else $err_msg = "Invalid username or password";
        }
    
    ?>
    <div class="row" id="login_container">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="login">
                <form action="login.php" method="post">
                    <h4 style="margin-left: 11%">Use the form below to login</h4><br>
                    <span id="err_msg" style="color: red; margin-left: 11%"><?php echo $err_msg; ?></span>
                    <div class="container">
                        <label for="username">Username</label><br>
                        <input type="text" name="username" value="<?php echo $username; ?>" required>
                    </div>
                    <div class="container">
                        <label for="password">Password</label><br>
                        <input type="password" name="password" value="<?php echo $password; ?>" required>
                    </div>
                    <div class="container">
                        <input type="submit" value="Submit">
                    </div>
                </form>
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
    


</body>      
</html>