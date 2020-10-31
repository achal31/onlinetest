<?php 
include ('header.php');
include ('admincheck.php');
include ('config.php');

/*------This Page is Used to show the admin the feature Edit/Delete/Add--------*/
if (isset($_POST['selectedquiz'])) {

    $selquiz=$_POST['selectedquiz'];
    

    /*----Show the quiz selected by the admin------*/
    $quiz="SELECT * FROM quiz where quiz_name='$selquiz'";
    $displayquiz=mysqli_query($conn, $quiz);
    $i=1;

    echo '<br>';
    echo '<table border= "3">';
    echo '<tr><th colspan="4">Questions</th><th>Action</th></tr>';

    while ($quizresult=mysqli_fetch_array($displayquiz)) {

        /*----Query to show the total question available in the quiz------*/
        $question="SELECT * from question where quiz_id='".$quizresult['quiz_id']."'";
        $displayquestion=mysqli_query($conn, $question);
        while ($questionresult=mysqli_fetch_array($displayquestion)) {
            ?>

<tr>  
    
<!------Showing all the available question and answer in the quiz in a column--------->
    <td colspan="4">
            
            <!------Showing the question------->
             Question:<?php echo $i; echo" ".$questionresult['question'];  echo'<br>';?>

            <?php 
            /*------Query to select the answer of the question-------*/
            $answer="SELECT * from answer where question_id='".$questionresult['question_id']."'";
            $displayanswer=mysqli_query($conn, $answer);
            while ($answerresult=mysqli_fetch_array($displayanswer)) {
                ?>
            
            <!------Showing the answer------->
            Option:<?php echo $answerresult['answer']; echo'<br>'?> 
    
                <?php
            }
                    /*------Showing Action to the admin------*/
                    echo '</td>';
                    echo "<td><form action='adminquestion.php' method='post'>
                    <input type='hidden' name='editquestionid' value='".$questionresult['question_id']."'>
                    <input type='hidden' name='editquizid' value='".$selquiz."'>
                    <input type='submit' name='edit' value='✎'/><input type='submit' name='delete' value='❌'/> </form></td>";
                    echo '</tr>';
                    $i++;
        }
         
        /*-----To Add New question to the same existing quiz=-------*/
        echo "To Add New Question to this Quiz";
        echo '<form method="post" action="adminquestion.php">
        <p>
        <input type="hidden" name="quizid" value="'.$quizresult['quiz_id'].'">
            <input type="submit" name="addquiz" value="'.$quizresult['quiz_name'].'" id="addquiz" >
        </p>
        </form> ';
       
    }

}
                    echo '</table>';
                    echo '<br>';
                    echo '<br>';
include ('footer.php');
?>