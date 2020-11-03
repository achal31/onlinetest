<?php 
include ('header.php');
include ('config.php');
?>

<h3>Select A Quiz </h3>

<!----Allow User To Select the Quiz He Want to View/Edit/Add/Update---->

<?php $select_quiz="SELECT * FROM quiz";
 $displayquiz=mysqli_query($conn, $select_quiz);

 while ($quizresult=mysqli_fetch_array($displayquiz)) {
     ?>
<!-----To Add New question to the same existing quiz=------->
<a class="linkbutton" href="updatequiz.php?selectedquiz=<?php echo $quizresult['quiz_id']; ?>"><?php echo $quizresult['quiz_name']; ?></a>

 <?php  } ?>


<?php

/*------This Page is Used to show the admin the feature Edit/Delete/Add--------*/
if (isset($_GET['selectedquiz'])) {
    echo "<br>";
    echo "<br>";
    echo "<p>";
        echo '<a class="linkbutton" href="adminquestion.php?getquizid='.$_GET['selectedquiz'].'">ADD NEW QUESTIONS</a>';
    echo "</p>";
        echo '<table border= "3">';
    echo '<tr><th colspan="4">Questions</th><th>Action</th></tr>';

    

        /*----Query to show the total question available in the quiz------*/
        $question="SELECT * from question where quiz_id='".$_GET['selectedquiz']."'";
        $displayquestion=mysqli_query($conn, $question);
        $i=1;
        while ($quizdetail=mysqli_fetch_array($displayquestion)) {
            ?>

<tr>  
    
<!------Showing all the available question and answer in the quiz in a column--------->
    <td colspan="4">
            
            <!------Showing the question------->
             Question:<?php echo $i; echo" ".$quizdetail['question'];  echo'<br>';?>
            
            <!------Showing the answer------->
            Option 1:<?php echo $quizdetail['answer_1']; echo'<br>'?> 
            Option 2:<?php echo $quizdetail['answer_2']; echo'<br>'?> 
            Option 3:<?php echo $quizdetail['answer_3']; echo'<br>'?> 
            Option 4:<?php echo $quizdetail['answer_4']; echo'<br>'?> 
    
                <?php
                $i++;
      
                    /*------Showing Action to the admin------*/
                    echo '</td>';
                    echo "<td><form action='adminquestion.php' method='post'>
                    <input type='hidden' name='editquestionid' value='".$quizdetail['question_id']."'>
                    <input type='hidden' name='editquizid' value='".$_GET['selectedquiz']."'>
                    <input type='submit' name='edit' value='✎'/><input type='submit' name='delete' value='❌'/> </form></td>";
                    echo '</tr>';
                  
        
        }
        
        
       
    
                    echo '</table>';
                    echo '<br>';
                    echo '<br>';
    }
include ('footer.php');
?>