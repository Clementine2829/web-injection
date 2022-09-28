<?php
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_REQUEST['trending'])){
            $sql = "SELECT blog.*, clients.first_name, clients.last_name, clients.role
                    FROM (blog 
                        INNER JOIN clients ON blog.posted_by = clients.id) 
                    WHERE blog.trending = 1";
            require("../includes/conn.inc.php");
            $sql_results = new SQL_results();
            $results = $sql_results->results_webhack($sql);
            $trending = array();
            $count = 0;
            if ($results->num_rows > 0) {
                while ($row = $results->fetch_assoc()) {                    
                    $trend = ($row["trending"] == 1) ? "Currently trending" : "";
                    $arr = array("id" => $row['id'],
                                "title" => $row['title'],
                                "details" => $row['details'],
                                "image" => $row['image'],
                                "posted_by" => $row['posted_by'],
                                "date_posted" => $row['date_posted'],
                                "name" => $row['first_name'] . " " . $row['last_name'] . " (" . $row['role'] . ")",
                                "trending" => $trend,
                                "category" => (($trend != "") ? $trend . " | " : "" ) . $row['category'],
                                "comments"=>"");
                    $id = $arr['id'];
                    $id = $arr['id'];
                    $arr['comments'] = get_comments($id);
                    array_push($trending, $arr);
                }
                echo print_data($trending);
            }
        }else if(isset($_REQUEST['technology'])){
            $sql = "SELECT blog.*, clients.first_name, clients.last_name, clients.role
                    FROM (blog 
                        INNER JOIN clients ON blog.posted_by = clients.id) 
                    WHERE blog.trending != 1";
            $trending = array();
            require("../includes/conn.inc.php");
            $sql_results = new SQL_results();
            $results = $sql_results->results_webhack($sql);
            $accommodation = array();
            if ($results->num_rows > 0) {
                while ($row = $results->fetch_assoc()) {
                    $trend = ($row["trending"] == 1) ? "Currently trending" : "";
                    $arr = array("id" => $row['id'],
                                "title" => $row['title'],
                                "details" => $row['details'],
                                "image" => $row['image'],
                                "posted_by" => $row['posted_by'],
                                "date_posted" => $row['date_posted'],
                                "name" => $row['first_name'] . " " . $row['last_name'] . " (" . $row['role'] . ")",
                                "trending" => $trend,
                                "category" => (($trend != "") ? $trend . " | " : "" ) . $row['category'],
                                "comments"=>"");
                    $id = $arr['id'];
                    $arr['comments'] = get_comments($id);
                    array_push($trending, $arr);
                }
                echo print_data($trending);
            }
        }else echo "Data not available";
    }
    function print_data($arr){
        if(sizeof($arr) > 0){
            foreach($arr as $blog => $value){
                $title = ((strlen($arr[$blog]['title'] > 150)) ? substr($arr[$blog]['title'], 0, 150) . ".." : $arr[$blog]['title']);
                $details = ((strlen($arr[$blog]['details'] > 500)) ? substr($arr[$blog]['details'], 0, 500) . ".." : $arr[$blog]['title']);
            ?>
                <div class="heading">
                    <h2><strong><?php echo $arr[$blog]['category']; ?> </strong></h2>
                </div>
                <div class="blog">
                    <p><strong><?php echo $title; ?></strong></p>
                    <div class="container">
                        <div class="image">
                            <a href="blog.php?blog=<?php echo $arr[$blog]['id']; ?>">
                                <img src="<?php echo $arr[$blog]['image']; ?>" alt="image" style="width:100%; height: 100%" />
                            </a>
                        </div>
                        <p><?php echo $details; ?></p>
                        <p class="details">
                            <span class="glyphicon glyphicon-time"></span>
                            <i><?php echo $arr[$blog]['date_posted'] . " " . $arr[$blog]['name']; ?></i>
                            <span class="comment">
                                <span class="glyphicon glyphicon-comment"></span> <?php echo $arr[$blog]['comments']; ?>
                            </span>
                        </p>
                    </div>
                </div>
            <?php
            }
        }else{
            echo "Data not available";
        }
    }
    function  get_comments($id){
        $sql = "SELECT name 
                FROM comments 
                WHERE blog_id = \"$id\"";
        $sql_results = new SQL_results();
        $results = $sql_results->results_webhack($sql);
        return $results->num_rows;
    }

?>