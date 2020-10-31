<?php 
include ('header.php');
include ('config.php');
?>
<!------This page is use to take the test of the student------->

<?php 
if ((isset($_GET['id']))||$_SESSION['selectquizid']) {
    if (isset($_GET['id'])) {
        /*-----Storing the quiz Id in session-------*/
        $_SESSION['selectquizid']=$_GET['id'];
    }
    
    /*-----Query to select the quiz-------*/
    $selectquiz="SELECT * FROM  quiz where quiz_id=".$_SESSION['selectquizid'];
    $quizname=mysqli_query($conn, $selectquiz);
    while ($showquiz=mysqli_fetch_array($quizname)) {
        
        /*-----Checking whether quiz has the pagination feature or not-------*/
        if ($showquiz['feature']==0) {

            /*-----Showing Quiz without the Pagination feature-------*/
            ?>

<form method="post" action="resultquiz.php">
            <?php         
            
            /*-----Query to show the question of the selected quiz-------*/
            $selectquestn="SELECT * FROM question WHERE quiz_id=".$_SESSION['selectquizid'];
            $questionname=mysqli_query($conn, $selectquestn);
            $i=1;
            while ($showquestion=mysqli_fetch_array($questionname)) {
    
                ?>

<label class="showquestion">Question <?php echo $i;?>.<?php echo $showquestion['question']; ?></label>
                
                <?php 

                /*-----Query to show the answer of the question---------*/

                $selectanswr="SELECT * FROM answer WHERE question_id='".$showquestion['question_id']."'";
                $answername=mysqli_query($conn, $selectanswr);
                $j=1;
                while ($showanswer=mysqli_fetch_array($answername)) {
                    ?>

    <p>
        <input type="radio" value="<?php echo $showanswer['answer_id']; ?>" name="option<?php echo $i; ?>" class="option">
        <label for="option"><?php echo $showanswer['answer']; ?></label>
    </p>
    
                    <?php 
                } $i++; 
            } 
            ?>
    <!-------To Submit the quiz------------->
    <input type="submit" name="submitquiz" value="SubmitQuiz">
</form>
                <?php 

                /*------Showing the Quiz when it has the pagination feature--------*/

        } else if ($showquiz['feature']==1) { 
            if (isset($_GET['quesId'])) { 
                if (empty($_SESSION['saveans'])) {
                    $_SESSION['saveans']=array();
                }
                $_SESSION['saveans'][$_GET['quesId']]=$_GET['ansid'];
            }
            
            /*-------Storing the page number--------*/
            if (isset($_GET['page'])) {
                    $page=$_GET['page'];
            } else {
                    $page=1;
            }
                $num_per_page=1;
                $start_from=($page-1)*1;

                /*------When Last Answer is selected the then result is calculated----------*/
            if (isset($_SESSION['totalques'])&&($_SESSION['totalques']==$page)) {
                    header("location:featureresult.php");
            }
            
            /*------Storing the quiz id--------*/

            if (isset($_GET['id'])||$_SESSION['selectquizid']) {
                if (isset($_GET['id'])) {       
                                                
                    $_SESSION['selectquizid']=$_GET['id'];
                    $_SESSION['totalques']=$_GET['totalquestion'];
                }

                $selectquestn="SELECT * FROM question WHERE quiz_id='".$_SESSION['selectquizid']."' limit $start_from,$num_per_page ";
                $questionname=mysqli_query($conn, $selectquestn);

                while ($showquestion=mysqli_fetch_array($questionname)) {

                ?>

<label class="showquestion" >Question.<?php echo $showquestion['question']; ?></label>
<input type="hidden" class="calquestion" id="quesId" name="quesId" value="<?php echo $showquestion['question_id']; ?>" >
 
      
                    <?php 
                    $selectanswr="SELECT * FROM answer WHERE question_id='".$showquestion['question_id']."'";
                    $answername=mysqli_query($conn, $selectanswr);
                    $j=1; $i=1;
                    while ($showanswer=mysqli_fetch_array($answername)) {
                        ?>

    <p>
        <!------Showing the option------->
        <input type="radio" value="<?php echo $showanswer['answer_id']; ?>" name="option<?php echo $i; ?>"  
        class="option" 
        <?php if(isset($_SESSION['saveans']) && isset($_SESSION['saveans'][$showquestion['question_id']]) && $_SESSION['saveans'][$showquestion['question_id']]==$showanswer['answer_id']) echo 'checked';  ?> >
        <label for="option"><?php echo $showanswer['answer']; ?></label>
    </p>
                        <?php 
                    }
                    $i++;
                } 
            }
            echo '<br>';

            /*---------Pagination Concept--------*/
            if ($page>1) {
                $currPage = $page-1;
                echo "<a class='black' onclick='getansw($currPage)'>PREVIOUS</a>\t";
            }

            if ($_SESSION['totalques']>=$page) {
                $currPage = $page+1;
                echo " <a class='black' onclick='getansw($currPage)'>NEXT</a>";
            }
        }
    }
}

?>



<script>
    /*-----Function called when next and previous are clicked------*/
    function getansw($page)
    {
        
        window.location.assign("takequiz.php?page="+($page)+"&quesId="+$("#quesId").val()+"&ansid="+$("input[type=radio]:checked").val());
    }
</script>