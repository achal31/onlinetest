<?php 
include('header.php');
include ('config.php');

/*-----This page is use to calculate the result of the quiz having pagination feature-------*/
$answer=0;
foreach ( $_SESSION['saveans'] as $key=>$value) {
        $checkques="SELECT * FROM question where question_id='".$key."' AND answer_correct='".$value."'" ;
    $displayques=mysqli_query($conn, $checkques);
    
    while ($quesresult=mysqli_fetch_array($displayques)) {
        /*-----Total correct answer-----*/
        $answer++;           
        
    }
    
}
    

echo "<label>Your Total Score is ".$answer." out of ".$_SESSION['totalques']."</label>";
echo "<br>";
if ($answer>($_SESSION['totalques']/2)) {
    echo "You Have Passed";
}
else
 echo "You Failed";

$_SESSION['saveans']="";
$_SESSION['totalques']=0;

include('footer.php');    
?>