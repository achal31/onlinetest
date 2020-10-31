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
<body id="adminpage">
<div id="wrapper">
    <h2 id="registerheading">ADMIN PORTAL</h2>
    <form id="register" method="post">
        
        <p>
            <input type="text" name="email" placeholder="Email" class="detail" required>
        </p>
        
        <p>
           <input type="password" name="password" placeholder="Password" class="detail" id="password" required>
        </p>
       
        <p>
            <input type="checkbox" onclick="myFunction()">Show Password
        </p>      
        <p>
        <input type="submit" name="adminlogin" value="Login" id="detailbutton">   
        <a href="register.php" class="linkbutton"> User Register</a> 
        <a href="login.php" class="linkbutton">Student Login</a>  
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