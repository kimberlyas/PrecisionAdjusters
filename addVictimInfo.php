<?php
    include "access.php";

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
         $sql = "INSERT into VictimInfo (trn, lname_acc, fname_acc, mname, address1_acc, address2_acc, email, home, cell, work, dob, occupation, mortalStatus) values ($trn, $lname, $fname, $mname, $address, $email, $hnumber, $cnumber, $wnumber, $dob, $occupation, $mStatus)";
   		 $result = mysql_query($sql,$conn) or die(mysql_error());
    }
?>