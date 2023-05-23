<?php 
    $host = "127.0.0.1";
    $user = "root";
    $passw = "12345";
    $database = "blog";
    $connect = mysqli_connect($host,$user,$passw,$database);
    session_start();
    $id="";
    if (isset($_SESSION["id"])) {
        $id = $_SESSION["id"];
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            if ($_POST["title"] != null && $_POST["post"] != null) {
                $id = $_SESSION["id"];
                $title = $_POST["title"];
                $post = $_POST["post"];
                post($post,$title,$id);
            }
            // Insert
            // INSERT INTO posts(post_title,post,post_date,id) value ($title,$post,current_date(),$id);
        }
    }
    else {
        header("location: login.php");
    }
    function post($post,$title,$id) {
        global $connect;
        $q = "insert into posts(post_title,post,post_date,id) value ('$title','$post',current_date(),$id)";
        $result = mysqli_query($connect,$q);
        if($result) {
            header("location: home.php?id=$id");
        }
        else {
            header("location: new-post.php");
        }
    }
    mysqli_close($connect);
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/all.min.css">
    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="newpost/postdesign.css">
    <title>New post</title>
</head>
<body>
    <nav>
        <div class="container">
            <div class="row">
                <div class="col-3 name-box">
                    <span>
                    <?php
                        
                        ?>
                    </span>
                </div>
                <div class="col-2 offset-2 img-box">
                        <a href="home.php">
                            <img src="home/images/blackemlogo.png" alt="blog logo" widt="56px" height="56px">
                        </a>
                </div>
                <div class="col-4 offset-1 right-box">
                    <div class="new-b d-none d-lg-flex">
                        <a href="new-post.php" class="">
                            <span class="">New post</span>
                        </a>
                    </div>
                    <div class="logout-box d-none d-lg-flex">
                        <a href="logout.php">   
                            <span class="">Logout</span>
                        </a>
                    </div>
                    <div class="dropdown d-flex d-lg-none">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="new-post.php">New post</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>   
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="post-cont">
        <div class="container">
            <div class="row">
                <div class="post-box col-8 offset-2" style="padding: 10px;">
                    <form action="" method="post">
                            <div class="title-box">
                                <label for="titlearea" class="fs-3" style="display: block;">Title: </label> 
                                <textarea name="title" id="titlearea" maxlength="100" required></textarea>
                            </div>
                            <div class="post-form">
                                <label for="postarea"  class="fs-3">New post: </label> 
                                <textarea name="post" maxlength="5000" id="postarea" required style="width: 100%; min-height: 150px;"></textarea>
                            </div>
                            <input type="submit" value="Post" class="btn btn-lg" >
                    </form> 
                </div>
            </div>
        </div>
    </div>
    <script src="fontawesome/all.min.js"></script>
    <script src="Bootstrap/bootstrap.bundle.min.js"></script>
    <script src="newpost/post.js"></script>
</body>
</html>