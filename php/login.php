<?php
 $firstname = $_POST['first-name'];
 $lastname = $_POST['last-name'];
 $telephone = $_POST['tel'];
 $company = $_POST['company'];
 $email = $_POST['email'];
 $comment = $_POST['comment'];
 
 //Check DB not be Empty
 if (!empty($firstname) || !empty($lastname) || !empty($telephone) || !empty($company) || !empty($email) || !empty($comment)) {
     // code...
     $host = "localhost";
     $dbUsername = "root";
     $dbPassword = "";
     $dbname = "login";
     
     //DB Connection
     
     $conn = new mysqli ($host, $dbUsername,$dbPassword,$dbname);
     if (mysqli_connect_error()) {
         ('.mysqli_connect_error()'.mysqli_connect_error());
     }else {
         $SELECT = "SELECT email From Register Where email=? Limit 1";
         $INSERT = "INSERT into Register(first-name,password,gender,email) values(?,?,?,?)";
         
         //prepare Statememt
         $stmt = $conn -> prepare ($SELECT);
         $stmt -> bind_param("s",$email);
         $stmt -> execute();
         $stmt -> bind_result($email);
         $stmt -> store_result ();
         $rnum = $stmt -> num_rows;
         
         if ($rnum == 0) {
             $stmt -> close();
             
             $stmt = $conn -> prepare ($INSERT);
             $stmt -> bind_param ("ssss", $firstname,$lastname, $telephone,$company,$email,$comment);
             $stmt -> execute();
             echo "New Record inserted Successfully";
         }else {
             echo "Someone already registered using this email";
         }
         $stmt -> close();
         $conn -> close();
     }
 }else {
    echo "All fields are Required";
    die();
 }
 
// The DB is available on the SQL folder
?>