<?php 
include ('header.php');
include ('config.php');
session_start();
?>

<!-------This Page consist of all feature update,add,delete,edit feature for admin------>


<?php 

/*------ This Function Will Delete The Selected Question and there answers-------*/

if (isset($_POST['delete'])) {  


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

    while ($showquiz=mysqli_fetch_array($question)) {


        /*----Script To Show the Question In The Field To The User-------*/

        echo '<script>
        $(document).ready(function(){
        $("#question").val("'.$showquiz['question'].'");
        $("#option1").val("'.$showquiz['answer_1'].'");
        $("#option2").val("'.$showquiz['answer_2'].'");
        $("#option3").val("'.$showquiz['answer_3'].'");
        $("#option4").val("'.$showquiz['answer_4'].'");
        $("#answer").val("'.$showquiz['answer_correct'].'");
        });
        </script>';

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
    
    /*---Query To Update the changes made in the quiz detail----*/

    $updateques="UPDATE question SET question='".$question."',answer_1='".$option1."',answer_2='".$option2."',answer_3='".$option3."',answer_4='".$option4."',answer_correct='".$answer."' WHERE question_id='".$_SESSION['ques_id']."'";
    $conn->query($updateques);
    
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
    else if (isset($_GET['getquizid'])) {
        $_SESSION['quiz_id']=$_GET['getquizid'];
    }
}    

/*------This Function will add question to the New/Exisitng quiz-------*/
if (isset($_POST['add'])) {
    
    $question=$_POST['question'];
    $option1=$_POST['option1'];
    $option2=$_POST['option2'];
    $option3=$_POST['option3'];
    $option4=$_POST['option4']; 
    $answer=$_POST['answer'];


    /*-----Query to insert the question------*/
    $insert_question="INSERT INTO question (quiz_id,question,answer_1,answer_2,answer_3,answer_4,answer_correct) VALUES('".$_SESSION['quiz_id']."','$question','$option1','$option2','$option3','$option4','$answer')";
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