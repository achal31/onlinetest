<?php
include('insert.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
<script src="https://www.w3schools.com/js/myScript1.js"></script>
</head>
<body id="loginpage">
<div id="wrapper">
    <h2 id="registerheading">STUDENT PORTAL</h2>
    <form id="register" method="post" action="login.php">
        
        <p>
            <input type="text" name="name" placeholder="Enter The User Name" class="detail" required>
        </p>
        
        <p>
           <input type="password" name="password" placeholder="Enter The Password" class="detail" id="password" required>
        </p>
       
        <p>
            <input type="checkbox" onclick="myFunction()">Show Password
        </p>      
        <p>
        <input type="submit" name="login" value="Login" id="detailbutton">   
        <a href="register.php" class="linkbutton"> User Register</a> 
        <a href="admin.php" class="linkbutton">Admin Login</a>  
        </p>
        
        <p>
          <label id="error">
            <?php if (sizeof($errors)>0): ?>
              <ul style="list-style: none;">
                  <?php foreach($errors as $error) :?>
                          <li style="color: red;"><?php  echo $error['msg']; ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif;?></label>
        </p>         
        
</form>
</div>
<script>
    function myFunction(id) {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

}

</script>
</body>
</html>