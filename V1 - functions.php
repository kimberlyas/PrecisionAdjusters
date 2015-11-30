<?php

	//include "dbaccess.php"; // Connection to PA_Database

	 //session_start(); // Start Session

	 //============================
 	 /* SEARCH QUERY FUNCTIONS */
  	//============================
	function search_by_trn($trn)
	{
		$data = null;
		$index = 0;
			
		$sql = "SELECT * FROM accinfo, victim_accinfo, vehicle_accinfo, insurance_cominfo, vehicleowner_icinfo WHERE '$trn'=victim_accinfo.trn AND victim_accinfo.accidentNo=accinfo.accidentNo AND accinfo.accidentNo=vehicle_accinfo.accidentNo AND vehicle_accinfo.vin=vehicleowner_icinfo.vin AND vehicleowner_icinfo.icname=insurance_cominfo.icname";
		$result = mysql_query($sql);

		if ($result === false) {
            echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            exit;
        }

        if (mysql_num_rows($result) > 0) { //If they match
         	
         	// Store all corresponding records into an array delimited by "?"
		
			while($row = mysql_fetch_array($result)) 
			{
				$data[$index] = $row['accidentNo'] . "?" . $row['location'] . "?" . $row['time'] . "?" . $row['date'] . "?" . $row['eyewitnessDetails'] . "?" . $row['sceneDescription'] . "?" . $row['trn'] . "?" . $row['lname_acc'] . "?" . $row['fname_acc'] . "?" . $row['mname'] . "?" . $row['address1_acc'] . "?" . $row['address2_acc'] . "?" . $row['email'] . "?" . $row['home'] . "?" . $row['cell'] . "?" . $row['work'] . "?" . $row['dob'] . "?" . $row['occupation'] . "?" . $row['mortalStatus'] . "?" . $row['vin'] . "?" . $row['plateNo'] . "?" . $row['type'] . "?" . $row['make'] . "?" . $row['model'] . "?" . $row['year'] . "?" . $row['damages'] . "?" . $row['icname'] . "?" . $row['address1_ic'] . "?" . $row['address2_ic'] . "?" . $row['ic_email'] . "?" . $row['phone'] . "?" . $row['fax'] . "?" . $row['policyNo'] . "?" . $row['lname_ic'] . "?" . $row['fname_ic'] . "?" . $row['mname_ic'] . "?" . $row['dlicense'];
				$index++;
			}
		
			return $data;
		}
		else //Error message
		{
			 echo "No records found";
		}
	}
	
	function search_by_vin($vin)
	{
		$data = null;
		$index = 0;
			
		$sql = "SELECT * FROM accinfo, victim_accinfo, vehicle_accinfo, insurance_cominfo, vehicleowner_icinfo WHERE '$vin'=vehicle_accinfo.vin AND victim_accinfo.accidentNo=accinfo.accidentNo AND accinfo.accidentNo=vehicle_accinfo.accidentNo AND vehicle_accinfo.vin=vehicleowner_icinfo.vin AND vehicleowner_icinfo.icname=insurance_cominfo.icname";
		$result = mysql_query($sql);

		if ($result === false) {
            echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            exit;
        }

        if (mysql_num_rows($result) > 0) { //If they match
         	
         	// Store all corresponding records into an array delimited by "?"
		
			while($row = mysql_fetch_array($result)) 
			{
				$data[$index] = $row['accidentNo'] . "?" . $row['location'] . "?" . $row['time'] . "?" . $row['date'] . "?" . $row['eyewitnessDetails'] . "?" . $row['sceneDescription'] . "?" . $row['trn'] . "?" . $row['lname_acc'] . "?" . $row['fname_acc'] . "?" . $row['mname'] . "?" . $row['address1_acc'] . "?" . $row['address2_acc'] . "?" . $row['email'] . "?" . $row['home'] . "?" . $row['cell'] . "?" . $row['work'] . "?" . $row['dob'] . "?" . $row['occupation'] . "?" . $row['mortalStatus'] . "?" . $row['vin'] . "?" . $row['plateNo'] . "?" . $row['type'] . "?" . $row['make'] . "?" . $row['model'] . "?" . $row['year'] . "?" . $row['damages'] . "?" . $row['icname'] . "?" . $row['address1_ic'] . "?" . $row['address2_ic'] . "?" . $row['ic_email'] . "?" . $row['phone'] . "?" . $row['fax'] . "?" . $row['policyNo'] . "?" . $row['lname_ic'] . "?" . $row['fname_ic'] . "?" . $row['mname_ic'] . "?" . $row['dlicense'];
				$index++;
			}
		
			return $data;
		}
		else //Error message
		{
			echo "No records found";
		}
	}
	
	function search_by_icname($icname)
	{
		$data = null;
		$index = 0;
			
		$sql = "SELECT * FROM accinfo, victim_accinfo, vehicle_accinfo, insurance_cominfo, vehicleowner_icinfo WHERE '$icname'=insurance_cominfo.icname AND victim_accinfo.accidentNo=accinfo.accidentNo AND accinfo.accidentNo=vehicle_accinfo.accidentNo AND vehicle_accinfo.vin=vehicleowner_icinfo.vin AND vehicleowner_icinfo.icname=insurance_cominfo.icname";
		$result = mysql_query($sql);

		if ($result === false) {
            echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            exit;
        }

        if (mysql_num_rows($result) > 0) { //If they match
         	
         	// Store all corresponding records into an array delimited by "?"
		
			while($row = mysql_fetch_array($result)) 
			{
				$data[$index] = $row['accidentNo'] . "?" . $row['location'] . "?" . $row['time'] . "?" . $row['date'] . "?" . $row['eyewitnessDetails'] . "?" . $row['sceneDescription'] . "?" . $row['trn'] . "?" . $row['lname_acc'] . "?" . $row['fname_acc'] . "?" . $row['mname'] . "?" . $row['address1_acc'] . "?" . $row['address2_acc'] . "?" . $row['email'] . "?" . $row['home'] . "?" . $row['cell'] . "?" . $row['work'] . "?" . $row['dob'] . "?" . $row['occupation'] . "?" . $row['mortalStatus'] . "?" . $row['vin'] . "?" . $row['plateNo'] . "?" . $row['type'] . "?" . $row['make'] . "?" . $row['model'] . "?" . $row['year'] . "?" . $row['damages'] . "?" . $row['icname'] . "?" . $row['address1_ic'] . "?" . $row['address2_ic'] . "?" . $row['ic_email'] . "?" . $row['phone'] . "?" . $row['fax'] . "?" . $row['policyNo'] . "?" . $row['lname_ic'] . "?" . $row['fname_ic'] . "?" . $row['mname_ic'] . "?" . $row['dlicense'];
				$index++;
			}
		
			return $data;
		}
		else //Error message
		{
			echo "No records found";
		}
	}
	
	function search_by_accidentNo($accidentNo)
	{
		$data = null;
			
		$sql = "SELECT * FROM accinfo, victim_accinfo, vehicle_accinfo, insurance_cominfo, vehicleowner_icinfo WHERE '$accidentNo'=accinfo.accidentNo AND victim_accinfo.accidentNo=accinfo.accidentNo AND accinfo.accidentNo=vehicle_accinfo.accidentNo AND vehicle_accinfo.vin=vehicleowner_icinfo.vin AND vehicleowner_icinfo.icname=insurance_cominfo.icname";
		$result = mysql_query($sql);

		if ($result === false) {
            echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            exit;
        }

        if (mysql_num_rows($result) > 0) { //If they match
         	
         	// Store all corresponding records into an array delimited by "?"
		
			while($row = mysql_fetch_array($result)) 
			{
				$data = $row['accidentNo'] . "?" . $row['location'] . "?" . $row['time'] . "?" . $row['date'] . "?" . $row['eyewitnessDetails'] . "?" . $row['sceneDescription'] . "?" . $row['trn'] . "?" . $row['lname_acc'] . "?" . $row['fname_acc'] . "?" . $row['mname'] . "?" . $row['address1_acc'] . "?" . $row['address2_acc'] . "?" . $row['email'] . "?" . $row['home'] . "?" . $row['cell'] . "?" . $row['work'] . "?" . $row['dob'] . "?" . $row['occupation'] . "?" . $row['mortalStatus'] . "?" . $row['vin'] . "?" . $row['plateNo'] . "?" . $row['type'] . "?" . $row['make'] . "?" . $row['model'] . "?" . $row['year'] . "?" . $row['damages'] . "?" . $row['icname'] . "?" . $row['address1_ic'] . "?" . $row['address2_ic'] . "?" . $row['ic_email'] . "?" . $row['phone'] . "?" . $row['fax'] . "?" . $row['policyNo'] . "?" . $row['lname_ic'] . "?" . $row['fname_ic'] . "?" . $row['mname_ic'] . "?" . $row['dlicense'];
			}
		
			return $data;
		}
		else //Error message
		{
			echo  "No records found";
		}
	}

	function explode_tables($var) 
	{
		// Table Arrays
  		$data = null;
  		$accInfo = null;
  		$victim_accinfo = null;
  		$vehicle_accinfo = null;
  		$insurance_cominfo = null;
  		$vehicleowner_icinfo = null;

  		// Iterating and using associative arrays
  		for($i=0; $i < count($var); $i++)
  		{
    		$data = explode("?",$var);
    		$accInfo[$i] = array("accidentNo"=>$data[0], "location"=>$data[1], "time"=>$data[2], "date"=>$data[3], "eyewitnessDetails"=>$data[4], "sceneDescription"=>$data[5]);
    		$victim_accinfo[$i] = array("trn"=>$data[6], "lname_acc"=>$data[7], "fname_acc"=>$data[8], "mname"=>$data[9], "address1_acc"=>$data[10], "address2_acc"=>$data[11], "email"=>$data[12], "home"=>$data[13], "cell"=>$data[14], "work"=>$data[15], "dob"=>$data[16], "occupation"=>$data[17], "mortalStatus"=>$data[18],"accidentNo"=>$data[0]);
    		$vehicle_accinfo[$i] = array("vin"=>$data[19], "plateNo"=>$data[20], "type"=>$data[21], "make"=>$data[22], "model"=>$data[23], "year"=>$data[24], "damages"=>$data[25], "accidentNo"=>$data[0]);
    		$insurance_cominfo[$i] = array("icname"=>$data[26], "address1_ic"=>$data[27], "address2_ic"=>$data[28], "email"=>$data[29], "phone"=>$data[30], "fax"=>$data[31]);
    		$vehicleowner_icinfo[$i] = array("policyNo"=>$data[32], "lname_ic"=>$data[33], "fname_ic"=>$data[34], "mname_ic"=>$data[35], "dlicense"=>$data[36], "vin"=>$data[19], "icname"=>$data[26]);
  		}

		// Assign session variables to store each table array for display in viewRecordss.php
  		$_SESSION["accInfo"] = $accInfo;
  		$_SESSION["victim_accInfo"] = $victim_accinfo;
  		$_SESSION["vehicle_accInfo"] = $vehicle_accinfo;
  		$_SESSION["insurance_cominfo"] = $insurance_cominfo;
  		$_SESSION["vehicleowner_icinfo"] = $vehicleowner_icinfo;
	}


  //============================
  /*      VIEW FUNCTIONS      */
  //============================
  function display_AccidentInfo()
  {
    //Accident Info
    if (isset($_SESSION["accInfo"]))
    {
    	// Assuming only one record will be found
       echo "<div>";
       echo "Accident No.: ".$_SESSION["accInfo"][0]['accidentNo'];
       echo "<br>";
       echo "Location: ".$_SESSION["accInfo"][0]['location'];
       echo "<br>";
       echo "Time: ".$_SESSION["accInfo"][0]['time'];
       echo "<br>";
       echo "Date: ".$_SESSION["accInfo"][0]['date'];
       echo "<br>";
       echo "Witness Statement: ".$_SESSION["accInfo"][0]['eyewitnessDetails'];
       echo "<br>";
       echo "Scene Description: ".$_SESSION["accInfo"][0]['sceneDescription'];
       echo "<br>";
       echo "</div>";
    }
   
  }
  
  function display_VictimInfo()
  {
    //Victim Info
    if (isset($_SESSION["victim_accInfo"]))
    {
      for($i=0; $i < count($_SESSION['victim_accInfo']); $i++)
      {
          echo "<div>";
          echo "Victim #".($i+1);
          echo "<br>";
          echo "Mortal Status: ".$_SESSION['victim_accInfo'][$i]['mortalStatus'];
          echo "<br>";
          echo "TRN: ".$_SESSION['victim_accInfo'][$i]['trn'];
          echo "<br>";
          echo "Last Name: ".$_SESSION['victim_accInfo'][$i]['lname_acc'];
          echo "<br>";
          echo "First Name: ".$_SESSION['victim_accInfo'][$i]['fname_acc'];
          echo "<br>";
          echo "Middle Name: ".$_SESSION['victim_accInfo'][$i]['mname'];
          echo "<br>";
          echo "Address: ".$_SESSION['victim_accInfo'][$i]['address1_acc']." ".$_SESSION['victim_accInfo'][$i]['address2_acc'];
          echo "<br>";
          echo "Occupation: ".$_SESSION['victim_accInfo'][$i]['occupation'];
          echo "<br>";
          echo "Contact Information ";
          echo "<br>";
          echo "E: ".$_SESSION['victim_accInfo'][$i]['email']." H: ".$_SESSION['victim_accInfo'][$i]['home']." C: ".$_SESSION['victim_accInfo'][$i]['cell']." W: ".$_SESSION['victim_accInfo'][$i]['work'];
          echo "<br>";
          echo "</div>";
      }
    }
  }
  
    function display_VehicleInfo()
  {
    //Vehicle Info
    if (isset($_SESSION["vehicle_accInfo"]))
    {
      for($i=0; $i < count($_SESSION['vehicle_accInfo']); $i++)
      {
          echo "<div>";
          echo "Vechicle #".($i+1);
          echo "<br>";
          echo "VIN: ".$_SESSION['vehicle_accInfo'][$i]['vin'];echo "<br>";
          echo "TRN: ".$_SESSION['vehicle_accInfo'][$i]['plateNo'];echo "<br>";
          echo "Type: ".$_SESSION['vehicle_accInfo'][$i]['type'];echo "<br>";
          echo "Make: ".$_SESSION['vehicle_accInfo'][$i]['make'];echo "<br>";
          echo "Model: ".$_SESSION['vehicle_accInfo'][$i]['model'];echo "<br>";
          echo "Year: ".$_SESSION['vehicle_accInfo'][$i]['year'];echo "<br>";
          echo "Damages: ".$_SESSION['vehicle_accInfo'][$i]['damages'];echo "<br>";
          echo "</div>";
      }
    }
  }
  
  function display_InsuranceInfo()
  {
    //Insurance Info
    if (isset($_SESSION["insurance_cominfo"]))
    {
      for($i=0; $i < count($_SESSION['insurance_cominfo']); $i++)
      {
          echo "<div>";
          echo "Insurance Company #".($i+1);echo "<br>";
          echo "Name: ".$_SESSION['insurance_cominfo'][$i]['icname'];echo "<br>";
          echo "Address: ".$_SESSION['insurance_cominfo'][$i]['address1_ic']." ".$_SESSION['insurance_cominfo'][$i]['address2_ic'];
          echo "<br>";
          echo "Email: ".$_SESSION['insurance_cominfo'][$i]['email'];echo "<br>";
          echo "Phone: ".$_SESSION['insurance_cominfo'][$i]['phone'];echo "<br>";
          echo "Fax: ".$_SESSION['insurance_cominfo'][$i]['fax'];echo "<br>";
          echo "</div>";
      }
    }
  }
  
  function display_OwnerInfo()
  {
    //Insured Vehicle Owner Info
    if (isset($_SESSION["vehicleowner_icinfo"]))
    {
      for($i=0; $i < count($_SESSION['vehicleowner_icinfo']); $i++)
      {
          echo "<div>";
          echo "Insured Vehicle Owner #".($i+1);echo "<br>";
          echo "Policy No.: ".$_SESSION['vehicleowner_icinfo'][$i]['policyNo'];echo "<br>";
          echo "Last Name: ".$_SESSION['vehicleowner_icinfo'][$i]['lname_ic'];echo "<br>";
          echo "First Name: ".$_SESSION['vehicleowner_icinfo'][$i]['fname_ic'];echo "<br>";
          echo "Middle Name: ".$_SESSION['vehicleowner_icinfo'][$i]['mname_ic'];echo "<br>";
          echo "Driver's License: ".$_SESSION['vehicleowner_icinfo'][$i]['dlicense'];echo "<br>";
          echo "</div>";
      }
    }
  }

?>
