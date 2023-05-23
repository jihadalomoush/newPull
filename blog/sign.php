<?php
// Connecting to the data base <----------------------- 
$host = "127.0.0.1";
$user = "root";
$passw = "12345";
$database = "blog";
$connect = mysqli_connect($host,$user,$passw,$database);
if (mysqli_connect_errno()) {
    die("connecting to the data base has been failed due to".mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["submit"])){
        if((trim($_POST["username"]) != null) && (trim($_POST["email"]) != null) && (trim($_POST["password"]) != null)){
            // getting the informations <----------
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = md5($_POST["password"]);
            // checking if the email is already used
            if(emCheck($email)){
                //inserting <---------------
                $signResult = signup($username,$email,$password);
                if($signResult){
                    header("location: login.php");
                    exit();
                }
                else{
                    echo 'failed';
                }
            }
            else{
                echo "this email is already used";
            }
        }
        else{
            echo "fill all the fields";
        }
    }
}
else{
    header("location: login.php");
    exit();
}
function emCheck($em){
    global $connect;
    $q = "select email from login where email like '$em'";
    $result = mysqli_query($connect,$q);
    if(mysqli_num_rows($result)){
        return 0;
    }
    else
        return 1;
}
function signup($name,$em,$pass){
    global $connect;
    $q = "insert into login(username,email,password) values ('$name','$em','$pass')";
    $result = mysqli_query($connect,$q);
    if($result){
        return 1;
    }
    else
        return 0;
}
//closing database <---------------
mysqli_close($connect);
?>