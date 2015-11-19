<?php
    if (isset($_POST['Save'])) {
         $fname = $_POST['fname'];
       	 $trn = $_POST['trn'];
         $mStatus = $_POST['mStatus'];
         $mname = $_POST['mname'];
         $address = $_POST['address'];
         $hnumber = $_POST['number'];
         $lname = $_POST['lname'];
         $email = $_POST['email'];
         $wnumber = $_POST['wnumber'];
         $dob = $_POST['dob'];
         $occupation = $_POST['occupation'];
         $cnumber = $_POST['cnumber'];
         $sql = "insert into VictimInfo (lName, mName, fName, trn, mStatus, address, email, occupation, dob, hNumber, wNumber, cNumber) values ($lname, $mname, $fname, $trn, $mStatus, $address, $email, $occupation, $dob, $hnumber, $wnumber, $cnumber, )";
   		 $result = mysql_query($sql,$conn) or die(mysql_error());
    }
?>