<?php 
include ('header.php');
include ('admincheck.php');
include ('config.php');

/*----This page is used to show the total records of the particular quiz to the admin-----*/

if(isset($_POST['selectedquiz']))
{   
    $selquiz=$_POST['selectedquiz'];
    
    /*----Query to show the selected quiz -------*/
    $quiz="SELECT * FROM quiz where quiz_name='$selquiz'";
    $displayquiz=mysqli_query($conn, $quiz);
    echo '<br>';
    echo '<table border= "3">';
    while ($quizresult=mysqli_fetch_array($displayquiz)) {

        /*-----Query to display the question------*/
        $question="SELECT * from question where quiz_id='".$quizresult['quiz_id']."'";
        $displayquestion=mysqli_query($conn, $question);
        while ($questionresult=mysqli_fetch_array($displayquestion)) {
            ?>

<tr> 
    <!-----Showing Question------->
    <td colspan="4">
        Question:<?php echo $questionresult['question']; ?>
    </td>
    </tr>
    <tr>

    <!-------Query to show the question of the particular quiz--------->
            <?php $answer="SELECT * from answer where question_id='".$questionresult['question_id']."'";
            $displayanswer=mysqli_query($conn, $answer);
            while ($answerresult=mysqli_fetch_array($displayanswer)) {
                ?>

    <!------Showing the answer of the particular question-------->
    <td>
        Option:<?php echo $answerresult['answer']; ?> 
    </td>
    

                <?php
            }
            echo '</tr>';
        }
    }
}
echo '</table>';
echo '<br>';
echo '<br>';
include ('footer.php');
?>