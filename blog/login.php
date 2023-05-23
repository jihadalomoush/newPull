<?php
    // Connecting to the data base <----------------------- 
$host = "127.0.0.1";
$user = "root";
$passw = "12345";
$database = "blog";
$connect = mysqli_connect($host,$user,$passw,$database);
session_start();
// if he logged in redirect him to home.php
$id="";
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
    header("location: home.php?id=$id");
    exit();
}
if (mysqli_connect_errno()) {
    die("connecting to the data base has been failed due to".mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        if((trim($_POST["email"]) != null) && (trim($_POST["password"]) != null)){
            $email = $_POST["email"];
            $password = md5($_POST["password"]);
            if (emCheck($email)) {
                login($email,$password);
            }
            else {
                echo "email is not exists";
            }
        }
}

function emCheck($em){
    global $connect;
    $q = "select email from login where email like '$em'";
    $result = mysqli_query($connect,$q);
    if(mysqli_num_rows($result)){
        return 1;
    }
    else
        return 0;
}

function login($em,$pass){
    global $connect;
    $q = "select password from login where email like '$em'";
    $result = mysqli_query($connect,$q);
    $row = mysqli_fetch_assoc($result);
        if ($row["password"] == $pass) {
            $qu = "select id from login where email like '$em'";
            $result = mysqli_query($connect,$qu);
            $idrow = mysqli_fetch_assoc($result);
            $_SESSION["id"] = $idrow["id"];
            $id = $_SESSION["id"];
            header("location: home.php?id=$id");
            exit();
        }
        else {
            echo "password is not correct";
        }
    
}
//closing database <---------------
mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/all.min.css">
    <link rel="stylesheet" href="login/designpage.css">
</head>
<body>
    <div class="log-box">
        <div class="home-cont">
            <a href="#home">
                <i class="fa-solid fa-house"></i>
            </a>
        </div>
        <div class="form-cont">
            <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
                <div>
                    <input type="email" id="em" name="email" autocomplete="off" minlength="5" required>
                    <span></span>
                    <label for="em">Email </label>
                </div>
                <div>
                    <input type="password" id="passw" name="password" autocomplete="off" required>
                    <span></span>
                    <label for="passw">Password </label>
                </div>
                <input type="submit" value="login" name="submit">
                <input type="button" value="Sign up" name="button" id="signbutton">
            </form>
        </div>  
    </div>
    <div class="signup-box">
        <h1>Sign up: </h1>
        <div class="form-cont">
            <form action="sign.php" method="POST">
                <div>
                    <input type="text" id="username" name="username" autocomplete="off" required>
                    <span></span>
                    <label for="uname">Username </label>
                </div>
                <div>
                    <input type="email" id="email" name="email" autocomplete="off" required>
                    <span></span>
                    <label for="email">Email </label>
                </div>
                <div>
                    <input type="password" id="password" name="password" autocomplete="off" minlength="8" required>
                    <span></span>
                    <label for="passw">Password </label>
                </div>
                <input type="submit" value="Sign up" name="submit">
                <input type="button" value="login" name="button" id="logbutton">
            </form>
        </div>
    </div>
    <script src="fontawesome/all.min.js"></script>
    <script src="bootstrap/bootstrap.bundle.min.js"></script>
    <script src="login/loginp.js"></script>
</body>
</html>