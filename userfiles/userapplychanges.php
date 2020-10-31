<?php 
include ('config.php');
session_start();

/*-------Function To Delte the user account-------*/
if(isset($_POST['yes']))
{
    $deleteaccount="DELETE FROM register WHERE user_name='".$_SESSION['name']."'";
    $conn->query($deleteaccount);
    header("location:../register.php");
} else if (isset($_POST['no'])) {
    header("location:indexstudent.php");
}


/*------Function to change the paasord of the student----*/
if (isset($_POST['savechange'])) {
    $currentpassword=$_POST['current'];
    $newpassword=$_POST['new'];
    $confirmpassword=$_POST['confirm'];

    $checkcurrentpassword="SELECT * FROM register WHERE user_name='".$_SESSION['name']."'";
    $check=mysqli_query($conn, $checkcurrentpassword);
 
    while ($showcurrentpassword=mysqli_fetch_array($check)) {
        if ($showcurrentpassword['user_password']==$currentpassword) {
            if ($newpassword==$confirmpassword) {
                $updatepassword="UPDATE register SET user_password='".$confirmpassword."' WHERE user_name='".$_SESSION['name']."'";
                $conn->query($updatepassword);
                header("location:../login.php");
            } else {
                echo "<h3>Feilds Password mismatch ,They must be same</h3>";
                echo "<h4>Go Back and check &#8592;</h4>";
            }
        } else {
            echo "<h3>You Entered Wrong Current Password</h3>";
            echo "<h4>Go Back and check  &#8592;</h4>";
        }
    }
}
?>