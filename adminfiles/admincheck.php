<?php 
include ('config.php');
?>
<h3>Select A Quiz </h3>

<!----Allow User To Select the Quiz He Want to View/Edit/Add/Update---->
<form method="post">

<?php $select_quiz="SELECT * FROM quiz";
 $displayquiz=mysqli_query($conn, $select_quiz);
 while ($quizresult=mysqli_fetch_array($displayquiz)) {
     ?>

<input type="submit" class="quiz" name="selectedquiz" value="<?php echo $quizresult['quiz_name']; ?>">

 <?php } ?>

</form> 
