<?php 
include ('header.php');
include ('config.php');


$checkquiz="SELECT * FROM quiz where quiz_id='".$_SESSION['selectquizid']."'";
$displayquiz=mysqli_query($conn, $checkquiz);
while ($quizresult=mysqli_fetch_array($displayquiz)) {
    $checkques="SELECT * FROM question where quiz_id='".$_SESSION['selectquizid']."'";
    $displayques=mysqli_query($conn, $checkques);
    $i=1;$j=0;$k=0;
    while ($quesresult=mysqli_fetch_array($displayques)) {
        $k++;
        if (isset($_POST['option'.$i.''])) {
            if ($quesresult['answer_id']==$_POST['option'.$i.'']) {
                $j++;
        }
        $i++;
    }
    }
    $i=$i-1;
    echo "<label>Your Total Score is $j out of $k </label>";
}
?>



<?php 
include ('footer.php');
?>