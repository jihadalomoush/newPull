<?php
    //Connect to tha Database
    $host = "127.0.0.1";
    $user = "root";
    $passw = "12345";
    $database = "blog";
    $connect = mysqli_connect($host,$user,$passw,$database);
    session_start();
    $id = "";
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        
    // $id = "";
    // if (isset($_SESSION["id"])) {
    //     $id = $_SESSION["id"];
        

    // o$1qCJchBEJ{fVp{
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
    <link rel="stylesheet" href="home/homepage.css">
    <title>Home</title>
</head>
<body>
    <!-- NAV BAR ----------------------------------- -->
    <nav>
        <div class="container">
            <div class="row">
                <div class="col-3 name-box">
                    <span>
                        <?php
                        $q = "select username from login where id = $id";
                        $result = mysqli_query($connect,$q);
                        $un = mysqli_fetch_assoc($result);
                        print($un["username"]);
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
    <!-- POSTS ---------------------------------------------------------------  -->
    <div class="posts">
        <div class="container">
            
            <div class="row">
            <?php 
            //select post_title , post_date,post from posts where id = 9;
                $query = "select post_title , post_date,post from posts where id = $id order by post_id desc;";
                $result = mysqli_query($connect,$query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $pt = $row["post_title"];
                    $pd = $row["post_date"];
                    $p = $row["post"];
                    $div = "<div class='post-cont col-12'><div class='post-card'> <div class='titdate'> <span class='title fs-3'> $pt </span> <span class='date'> $pd </span>  </div> <div class='text'> <span> $p </span> </div></div> </div>";
                    print($div);
                }
            }
            else{
                header("location: login.php");
                exit();
            }
                mysqli_close($connect);
            ?>
            </div>
        </div>
    </div>
    
    <script src="fontawesome/all.min.js"></script>
    <script src="Bootstrap/bootstrap.bundle.min.js"></script>
    <script src="home/designpage.js"></script>
</body>
</html>