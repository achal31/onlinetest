<?php 
include ('header.php');
include ('config.php');
?>
<h3>Select A Quiz </h3>

<!------To show the total quiz to the student------>
<form method="post" action="takequiz.php">

<!-----Query to select the quiz--------->
<?php $select_quiz="SELECT * FROM quiz";
 $displayquiz=mysqli_query($conn, $select_quiz);
 
while ($quizresult=mysqli_fetch_array($displayquiz)) {

    /*----Query to count the total question the quiz to pass as href------*/
   
    $selectquestn="SELECT * FROM question WHERE quiz_id=".$quizresult['quiz_id'];
    $questionname=mysqli_query($conn, $selectquestn);
    $totalquestion=mysqli_num_rows($questionname);
    ?>
    <a href="takequiz.php?id=<?php echo $quizresult['quiz_id']; ?>&totalquestion=<?php echo $totalquestion; ?>" class="linkbutton"><?php echo $quizresult['quiz_name']; ?></a>
      <?php      
} 
echo '</form>';
include ('footer.php');
?>