<?php 
include('insert.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="style.css">
<script src="https://www.w3schools.com/js/myScript1.js"></script>
</head>
<body id="registerpage">
<div id="wrapper">
    <h2 id="registerheading">ONLINE TEST PORTAL</h2>
    <form id="register" method="post" action="register.php">
        <p>
            <select class="detail" name="title" required >
            <option value="" disabled selected>Title</option>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            </select>
        </p>
        <p>
            <input type="text" name="user_name" placeholder="Your Name" class="detail"  required> 
        </p>
        <p>
            <input type="text" name="email" placeholder="Email" class="detail" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninvalid="InvalidMsg(this);" 
                   oninput="InvalidMsg(this);" required>
        </p>
        <p>
            <input type="text" name="number" placeholder="Enter 10 Digit Phone Number" class="detail" id="phone" oninvalid="InvalidMsg(this);" 
                   oninput="InvalidMsg(this);" pattern="[1-9]{1}[0-9]{9}" required >
            
        </p>
        <p>
           <input type="password" name="password" placeholder="Password" class="detail" id="password" pattern=".{8,}" required>
        </p>
        <p>
            <input type="password" name="repassword" placeholder="Confirm Password" class="detail" id="repassword" required>
            
        </p>
        <p>
            <input type="checkbox" onclick="myFunction()">Show Password
        </p>      
        <p>
        <input type="submit" name="register" value="Register" id="detailbutton">   
        <a href="login.php" class="linkbutton">Student Login</a> 
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
  function InvalidMsg(textbox) { 
    if(textbox.id=='phone')
  {
  if (textbox.value === '') { 
      textbox.setCustomValidity 
            ('Entering an Phone Number is necessary!'); 
  } else if (textbox.validity.patternMismatch) { 
      textbox.setCustomValidity 
            ('Please enter an Phone Number address which is valid!'); 
  } else { 
      textbox.setCustomValidity(''); 
  } 
}
if(textbox.id=='email')
  {
  if (textbox.value === '') { 
      textbox.setCustomValidity 
            ('Entering an email-id is necessary!'); 
  } else if (textbox.validity.patternMismatch) { 
      textbox.setCustomValidity 
            ('Please enter an email address which is valid!'); 
  } else { 
      textbox.setCustomValidity(''); 
  } 
}

  
} 
  
    function myFunction(id) {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }

var y = document.getElementById("repassword");
  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
}

</script>
</body>
</html>