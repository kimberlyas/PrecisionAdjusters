<?php
    $db = mysql_connect(“localhost”, “user”);
    Mysql_select_db(“PA_Database”);


    $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

    if (!$link) {
        die('Could not connect: ' . mysql_error());
     }

     $db_selected = mysql_select_db(DB_NAME, $link);

     if (!$db_selected) {
     die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
     }

    if (isset($_POST['Save'])) {
         $fname = $_POST['FNAME'];
       	 $trn = $_POST['TRN'];
         $mStatus = $_POST['MSTATUS'];
         $mname = $_POST['MNAME'];
         $address1 = $_POST['ADDRESS1'];
         $address2 = $_POST['ADDRESS2'];
         $hnumber = $_POST['NUMBER'];
         $lname = $_POST['LNAME'];
         $email = $_POST['EMAIL'];
         $wnumber = $_POST['WNUMBER'];
         $dob = $_POST['DOB'];
         $occupation = $_POST['OCCUPATION'];
         $cnumber = $_POST['cnumber'];
         $sql = "INSERT into victim_accinfo (trn, lname_acc, fname_acc, mname, address1_acc, address2_acc, email, home, cell, work, dob, occupation, mortalStatus) values ($trn, $lname, $fname, $mname, $address, $email, $hnumber, $cnumber, $wnumber, $dob, $occupation, $mStatus)";
   		 
   		 $result = mysql_query($sql);
    }
?>