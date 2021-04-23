<?php 
$student_id = $_POST["id"];
$firstname = $_POST["first_name"];
$lastname = $_POST["last_name"];

 $conn = mysqli_connect("localhost","root","","ajac") or die("connecton failed");

$sql = "UPDATE student SET first_name='{$firstname}',last_name={$lastname}	 WHERE id={$studentId}";

 if(mysqli_query($conn, $sql)){
 	echo 1;

 }else{
 	echo 0;
 }



?>