<?php 
include ('config.php');
session_start();
$errors=array();


/*------Function use to register the user-------*/

if (isset($_POST['register'])) {
    $title=$_POST['title'];
    $name=$_POST['user_name'];
    $email=$_POST['email'];
    $number=$_POST['number'];
    $password=$_POST['password'];
    $repassword=$_POST['repassword'];
      
    if ($password==$repassword) {
        $check = "SELECT * FROM register WHERE user_name='$name' OR user_email='$email' OR user_number='$number'";
        
        $input_detail = $conn->query($check);
        
        if ($input_detail->num_rows ==0) {
        
        $sql = "INSERT INTO register (user_title, user_name, user_email,user_number,user_password)
        
        VALUES ('$title', '$name', '$email','$number','$password')";
            if ($conn->query($sql)== true) {

                header("Location:login.php");
            }
        } else {
            $errors[]=array('input'=>'password','msg'=>'Input feild value already exist');
        }
    } else {
        $errors[]=array('input'=>'password','msg'=>'Entered Password doesnt match');
    }
}

/*------Function use to login the user to the indexstudent.php--------*/

if(isset($_POST['login']))
{
    $name=$_POST['name'];
    $_SESSION['name']=$name;
    $password=$_POST['password'];
    $sql = "SELECT * FROM register WHERE user_name='".$name."' AND user_password='".$password."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        header("Location:userfiles/indexstudent.php");
    } else {
        $errors[]=array('input'=>'password','msg'=>'Entered name or Password is wrong');
    }
}

/*----------Function to login admin to the indexadmin.php------*/
if(isset($_POST['adminlogin']))
{
    $email=   $email=$_POST['email'];
    $password=$_POST['password'];
    $sql = "SELECT * FROM admin WHERE admin_email='".$email."' AND admin_password='".$password."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        header("Location:adminfiles/indexadmin.php");
    } else {
        $errors[]=array('input'=>'password','msg'=>'Entered Email or Password is wrong');
    }
}
?>
