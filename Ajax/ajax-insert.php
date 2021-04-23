<?php 
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];


 $conn = mysqli_connect("localhost","root","","ajac") or die("connecton failed");

 $sql = "INSERT INTO student(firstname, lastname) VALUES ('{$firstname}','{$lastname}')";

 if(mysqli_query($conn,$sql)){
 	echo 1;

 }else{
 	echo 0;
 }



?>