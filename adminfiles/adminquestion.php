<?php 
include ('header.php');
include ('config.php');
session_start();
?>
<?php 

/*------ This Function Will Delete The Selected Question and there answers-------*/

if (isset($_POST['delete'])) {  

    /*----Deletion Query For the Selected question---------*/

    $deleteanswer="DELETE FROM answer WHERE question_id=".$_POST['editquestionid'];
    $conn->query($deleteanswer);

    /*----Deletion Query For the Selected question's Answer ---------*/

    $deletequestion="DELETE FROM question where question_id='".$_POST['editquestionid']."'";
    $conn->query($deletequestion);

    /*---After Deletion Header will redirect to updatequiz page-----*/

    header("location:updatequiz.php");

}

/*----This Function Will Edit The Values And Will Display Values in the Desired Fields-----*/

if (isset($_POST['edit'])) {

    echo '<h4>Enter detail to update the selected question</h4>';

      /*-----Values Storing In Session-------------*/

      $_SESSION['quiz_id']=$_POST['editquizid'];
      $_SESSION['ques_id']=$_POST['editquestionid'];

    /*------Query To Edit the Selected Question-------*/

    $editques="SELECT * FROM question WHERE question_id='".$_SESSION['ques_id']."'";
    $question=mysqli_query($conn, $editques);

    while ($showquestion=mysqli_fetch_array($question)) {


        /*----Script To Show the Question In The Field To The User-------*/

        echo '<script>
        $(document).ready(function(){;
        $("#question").val("'.$showquestion['question'].'");
        });
        </script>';

    
          /*------Query To Edit the Selected Question's Answer-------*/

        $editanswer="SELECT * FROM answer WHERE question_id='".$_SESSION['ques_id']."'";
        $answer=mysqli_query($conn, $editanswer);
        $i=1;
        while ($showanswer=mysqli_fetch_array($answer)) {

            /*-----Script To Show The Answers In the fields----*/

            echo '<script>$(document).ready(function(){
                    $("#option'.$i.'").val("'.$showanswer['answer'].'");
                        });</script>';
            $i++;
        }

        /*------Query To Edit the Selected Question's Correct Answer-------*/

        $correct_answer="SELECT * from answer where answer_id='".$showquestion['answer_id']."'";
        $canswer=mysqli_query($conn, $correct_answer);
        while ($sanswer=mysqli_fetch_array($canswer)) {

             /*-----Script To Show The Correct Answers In the fields----*/

            echo '<script>$(document).ready(function(){
                $("#answer").val("'.$sanswer['answer'].'");
                });</script>';
        }
    }
}



/*----This Function Will Update the changes made by the user------*/

if (isset($_POST['add'])&&isset($_POST['edit'])) {
    $question=$_POST['question'];
    $option1=$_POST['option1'];
    $option2=$_POST['option2'];
    $option3=$_POST['option3'];
    $option4=$_POST['option4']; 
    $answer=$_POST['answer'];
    
    /*---Query To Update the changes made in the questions-----*/

    $updateques="UPDATE question SET question='".$question."' WHERE question_id='".$_SESSION['ques_id']."'";
    $conn->query($updateques);
    

     /*---Query To Update the changes made in the answer-----*/

    $sle="SELECT * FROM answer WHERE question_id='".$_SESSION['ques_id']."'";
    $canswer=mysqli_query($conn, $sle);
    while ($sanswer=mysqli_fetch_array($canswer)) {
        $slect= $sanswer['answer_id']-3;
    }
    echo $slect;
    $updateanswer="UPDATE answer SET answer='".$option1."' WHERE answer_id='".$slect."'";
    $conn->query($updateanswer);
    $slect=$slect+1;
    $updateanswer="UPDATE answer SET answer='".$option2."' WHERE answer_id='".$slect."'";
    $conn->query($updateanswer);
    $slect=$slect+1;
    $updateanswer="UPDATE answer SET answer='".$option3."' WHERE answer_id='".$slect."'";
    $conn->query($updateanswer);
    $slect=$slect+1;
    $updateanswer="UPDATE answer SET answer='".$option4."' WHERE answer_id='".$slect."'";
    $conn->query($updateanswer);


     /*---Query To Update the changes made in the Correct Answer----*/

    $correct_answer="SELECT * FROM answer WHERE answer='$answer'";
    $displayquery=mysqli_query($conn, $correct_answer);
    while ($correctanswerid=mysqli_fetch_array($displayquery)) {
        $answerid=$correctanswerid['answer_id'];
    }

    $updatecorrect="UPDATE question SET answer_id='".$answerid."' WHERE question_id='".$_SESSION['ques_id']."'";
    $conn->query($updatecorrect);
     
    /*----Header Will move to viewquiz.php-------*/

    header("location:viewquiz.php");
}
    


/*----This Function Will Allow User To Add New quiz---*/

if (isset($_POST['addquiz'])) {
    if (isset($_POST['quizname'])) {   
        $feature=$_POST['feature'];
        $_SESSION['quizname']=$_POST['quizname'];
        echo' <h4>Adding Questions For Quiz : '.$_SESSION['quizname'].'</h4>';
        $quizname=$_POST['quizname'];
        $sql="INSERT INTO quiz (quiz_name,feature) VALUES('$quizname','$feature')";
        $conn->query($sql);
        $last_id = $conn->insert_id;
        $_SESSION['quiz_id']=$last_id;
    }

    /*-----This Function Will Allow User Add new question to Existing Quiz-----*/
    else if (isset($_POST['addquiz'])&&empty($_POST['quizname'])) {
        $_SESSION['quiz_id']=$_POST['quizid'];
    }
}    

/*------This Function will add question to the quiz-------*/
if (isset($_POST['add'])) {
    
    $question=$_POST['question'];
    $option1=$_POST['option1'];
    $option2=$_POST['option2'];
    $option3=$_POST['option3'];
    $option4=$_POST['option4']; 
    $answer=$_POST['answer'];


    /*-----Query to insert the question------*/
    $insert_question="INSERT INTO question (quiz_id,question) VALUES('".$_SESSION['quiz_id']."','$question')";
    $conn->query($insert_question); 
    $quesid = $conn->insert_id;

            /*------Query to insert the answer to the database-----*/
            $insert_answer="INSERT INTO answer (answer,question_id) VALUES('$option1','$quesid')";
            $conn->query($insert_answer);
            $insert_answer="INSERT INTO answer (answer,question_id) VALUES('$option2','$quesid')";
            $conn->query($insert_answer);
            $insert_answer="INSERT INTO answer (answer,question_id) VALUES('$option3','$quesid')";
            $conn->query($insert_answer);
            $insert_answer="INSERT INTO answer (answer,question_id) VALUES('$option4','$quesid')";
            $conn->query($insert_answer);

            /*------Query to insert the correct answer id to the database-----*/
            $correct_answer="SELECT * FROM answer WHERE answer='$answer'";
            $displayquery=mysqli_query($conn, $correct_answer);
    while ($correctanswerid=mysqli_fetch_array($displayquery)) {
         $answerid=$correctanswerid['answer_id'];
    }
    $insert_question="INSERT INTO question (answer_id) VALUES('$answerid') WHERE question_id='".$quesid."'";
    $conn->query($insert_question); 
}
?>
   
    <div id="wrapperadmin">
       
            <div id="insertquestion">
               <form method="post" action="adminquestion.php">
              
            <p>
                <input type="text" name="question" id="question" class="ques" placeholder="Enter The Question" required>
            </p>

            <p>
                <input type="text" name="option1" id="option1" class="ques" placeholder="Enter Option1" required>
            </p>

            <p>
            <input type="text" name="option2" id="option2" class="ques" placeholder="Enter Option2" required>
            </p>

            <p>
            <input type="text" name="option3" id="option3" class="ques" placeholder="Enter Option3" required>
            </p>

            <p>
            <input type="text" name="option4" id="option4" class="ques" placeholder="Enter Option4" required>
            </p>

            <p>
                <input type="text" name="answer" id="answer" class="ques" placeholder="Enter the Answer" required>
            </p>

            <p>
                <input type="submit" name="add" value="Save" id="addquestion">
            </p>

        </form>
        </div>
        
        
<?php 
include ('footer.php');
?>