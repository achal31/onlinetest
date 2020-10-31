<?php 
include('header.php');
session_start();


/*------Confirm whether user want to delete the account or not-------*/
if(isset($_GET['delete']))
{
    echo "<h3>Are You Sure?</h3>";
    echo "<h4>You Want To Delete The Account</h4>";
    echo "<form action='userapplychanges.php' method='post'>
         <input type='submit' name='yes' value='Yes'>
         <input type='submit' name='no' value='No'>
    </form>";
}


/*-------To mention the currect and the new password by the user------*/
if(isset($_GET['change']))
{     echo "<h4>Please Fill The Detail</h4>";
     echo "<form action='userapplychanges.php' method='post' >";
     echo "<p>";
    echo "<input type='text' name='current' class='detail' placeholder='Enter The Current Password' required>";
    echo "</p>";
    echo "<p>";
    echo "<input type='text' name='new' class='detail' placeholder='Enter The New Password' required>";
    echo "<p>";
    echo "<p>";
    echo "<input type='text' name='confirm' class='detail' placeholder='Enter Password Again To Confirm' required>";
    echo "<p>";
    echo "<input type='submit' name='savechange' value='Save'>";
    echo "</form>";
}
?>

<?php 
include ('footer.php');
?>