<?php 
include ('header.php');
include ('config.php');
?>

<!-------This page is used to show the total records of the particular quiz to the admin----->

<h3>Select A Quiz </h3>

<!----Allow User To Select the Quiz He Want to View/Edit/Add/Update---->

<?php $select_quiz="SELECT * FROM quiz";
 $displayquiz=mysqli_query($conn, $select_quiz);

 while ($quizresult=mysqli_fetch_array($displayquiz)) {
     ?>

<a class="linkbutton" href="viewquiz.php?selectedquiz=<?php echo $quizresult['quiz_id']; ?>"><?php echo $quizresult['quiz_name']; ?></a>

 <?php  } ?>




<?php
/*----This page is used to show the total records of the particular quiz to the admin-----*/

if(isset($_GET['selectedquiz']))
{   
  
    echo '<br>';
    echo '<table border= "3">';
    

        /*-----Query to display the question------*/
        $question="SELECT * from question where quiz_id='".$_GET['selectedquiz']."'";
        $displayquestion=mysqli_query($conn, $question);
        $i=1;
        while ($questionresult=mysqli_fetch_array($displayquestion)) {
            ?>

<tr> 
    <!-----Showing Question------->
    <td colspan="4">
        Question:<?php echo $i; echo $questionresult['question']; ?>
    </td>
    </tr>
    <tr>

    <!------Showing the answer of the particular question-------->
    <td colspan="4">
        Option 1:<?php echo $questionresult['answer_1']; echo"<br>"; ?> 
        Option 2:<?php echo $questionresult['answer_2']; echo"<br>"; ?> 
        Option 3:<?php echo $questionresult['answer_3']; echo"<br>"; ?> 
        Option 4:<?php echo $questionresult['answer_4']; echo"<br>"; ?> 
    
    </td>
    

                <?php
            
            echo '</tr>';
       $i++; }
    
echo '</table>';
echo '<br>';
echo '<br>';
}
include ('footer.php');
?>