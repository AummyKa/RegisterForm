


<?php 



	if (!empty($_POST)) {
		//print_r($_POST); exit();
		if(checkUserInTable())
		{
			addNewUser();
		}
	}

	function connect_db()
	{
		//Connect to database
		$str_server = "localhost";
		$str_username = "root";
		$str_password = "";
		$str_dbname = "n_database";

		$obj_con = mysql_connect($str_server,$str_username,$str_password,$str_dbname)
		or die("Failed to connect to MySQL: " . mysql_error());

		$db = mysql_select_db($str_dbname,$obj_con) or die("Failed to connect to MySQL: " . mysql_error());

		mysql_query("SET NAMES UTF8");


		if (mysqli_connect_errno($obj_con)) { 
		echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
		} else { 
		// echo "Successfully connected to your database…"; 
		}
	}

	//Connect the user
	function addNewUser() { 

		connect_db();
		
		$name = $_POST['name']; 
		$lastname = $_POST['lastname']; 
		$username = $_POST['username']; 
		$password = $_POST['password'];
		$sex = $_POST['sex'];
		$b_date = $_POST['date_of_birth'];
				
		$interest ="";
		foreach($_POST['interest'] as $check_itr){
			$interest .= $check_itr."  ";
		}
		
		
		$query = "INSERT INTO user (name,lastname,username,password,sex,date_of_birth,interest) 
		VALUES ('$name','$lastname','$username','$password','$sex','$b_date','$interest')"; 
		
		$data = mysql_query ($query)or die(mysql_error()); 

		if($data) { 
			echo "YOUR REGISTRATION IS COMPLETED..."; 
		} 

	} 
		
	function checkUserInTable() { 

		connect_db();
		if(!empty($_POST['name'])) //checking the 'user' name not to have same text and empty
		{ 
			$query = mysql_query("SELECT * FROM user WHERE username = '".$_POST['username']."'") 
			or die(mysql_error()); 

			if(!$row = mysql_fetch_array($query)) { 
				
				return true;
			} 
			else
			{ 
				echo "SORRY...YOU ARE ALREADY REGISTERED USER : ".$_POST['username'];
				return false; 
			} 
		} 
	} 
			
?>

<form id='register' action='register.php' onsubmit="return validateForm()" method='post' accept-charset='UTF-8'>

	<fieldset >
		<legend>Register</legend>
			<input type='hidden' name='submitted' id='submitted' value='1'/></br>
				
				<label for='name' >First Name: </label>
				<input type='text' name='name' id='name' maxlength="50" /></br></br>

				<label for='lastname' >Last Name: </label>
				<input type='text' name='lastname' id='lastname' maxlength="50" /></br></br>
 				
 				<label for='username' >UserName:</label>
				<input type='text' name='username' id='username' maxlength="50" /></br></br>
	
				<label for='password' >Password :</label>
				<input type='password' name='password' id='password' maxlength="50" /></br></br>

				<label for='Sex' >Sex :</label>
					<input type="radio" name="sex" value="Male"> Male 
					<input type="radio" name="sex" value="Female"> Female 
				</br></br>

				<label for='Birthday' >Birthday :</label>
				<input type="date" name="date_of_birth"></br></br>

				<label for='Interest' >Interest :</label>
					<input type="checkbox" name="interest[]" value="Games">Games
					<input type="checkbox" name="interest[]" value="Sport">Sport
					<input type="checkbox" name="interest[]" value="Music">Music 
				</br></br>
														
				<input type='submit' name='Submit' value='Submit' />
				
 
	</fieldset>

</form>

<script>

function validateForm() {

    var name = document.forms["register"]["name"].value;
    var lastname = document.forms["register"]["lastname"].value;
    var username = document.forms["register"]["username"].value;
    var password = document.forms["register"]["password"].value;
    var b_date = document.forms["register"]["date_of_birth"].value;
    var itr = document.getElementsByName('interest[]');
	
	var check_var = false;
    var msg = '';
	var unchecked_count =0;

	for (var i = 0; i < itr.length; i++)
	{
		if (itr[i].checked){ break;
		} else unchecked_count++;
	}
	
		if(count==itr.length){
			msg +="\n Please choose of one of your interest";
			check_var = true;
		}  
    
    if (name == null || name == "") {
        msg +="\n Name must be filled out";
        check_var = true;
    }
    if (lastname == null || lastname == "") {
         msg +="\n Last name must be filled out";
        check_var = true;
    }
    if (username == null || username == "") {
         msg +="\n Username must be filled out";
        check_var = true;
    }
    if (password == null || password == "") {
         msg +="\n Password must be filled out";
        check_var = true;
    }
    if (b_date == null || b_date == "") {
         msg +="\n Date is invalid";
        check_var = true;
    }
  
      
	  
    if(check_var)
    {
    	alert(msg);
    	return false;
    }
    else
    {
    	return true;
    }
    
}
</script>