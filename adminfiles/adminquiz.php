<?php 
include ("header.php");
include ("config.php");

?>

<!----Form to show the quiz to the user------->
<form method="post" action="adminquestion.php">
<p>
    <!-----Input for entering quiz name-------->
    <input name="quizname" type="text" id="quiz" placeholder="Enter Quiz name" required> 
    
    <!------Ask user whether he want to provide pagination feature to the user or not------->
    <select name="feature" class="detail" required>
    <option value="" disabled selected>Allow Next/Previous Feature</option>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
</p>
<p>
    <input type="submit" name="addquiz" value="Add Quiz" id="quizbutton" >
</p>
</form> 

<!---Table to show the existing quiz to the user------>
<div id="availablequiz">

<table>
    <tr>
        <th>S.No</th>
        <th>Available Quiz</th>
        <th>Pagination Feature</th>
    </tr>
<!----Query to show the Existing quiz in the database----->    
<?php $select_quiz="SELECT * FROM quiz";
 $displayquiz=mysqli_query($conn, $select_quiz);
 $i=1;
while ($quizresult=mysqli_fetch_array($displayquiz)) {
    ?>

<tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $quizresult['quiz_name'];  ?></td>
<td><?php if ($quizresult['feature']==1) { echo "Yes"; } else {echo "No"; } ?></td>
</tr>

 <?php $i++; } ?>
 
</table>
</div>
<?php 
include ("footer.php");
?>