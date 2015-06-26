<?php



	if (!empty($_POST)) {
		//print_r($_POST); exit();
		if(checkUserInTable())
		{
			echo "Your register is completed";
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

		try{
		$conn = new PDO('mysql:host='.$str_server.';dbname='.$str_dbname,$str_username,$str_password);
		} catch(PDOException $e) {
		    echo 'ERROR: ' . $e->getMessage();
		   

		}
		return $conn;		
	}

	//Connect the user
	function addNewUser() { 

		// connect_db();
		connect_db()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO user(name,lastname,username,password,sex,date_of_birth,interest) 
		VALUES (:name,:lastname,:username,:password,:sex,:b_date,:interest)";    
                                          
		$stmt = connect_db()->prepare($sql);

				                                              
		$stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);       
		$stmt->bindParam(':lastname', $_POST['lastname'], PDO::PARAM_STR); 
		$stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
		// use PARAM_STR although a number  
		$stmt->bindParam(':password', $_POST['password'], PDO::PARAM_STR); 
		$stmt->bindParam(':b_date', $_POST['date_of_birth'], PDO::PARAM_STR);
		$stmt->bindParam(':sex', $_POST['sex'], PDO::PARAM_STR);   
		$stmt->bindParam(':interest',implode(',',$_POST['interest']), PDO::PARAM_STR); 
	
		$stmt->execute();
		
		
	} 
		
	function checkUserInTable() { 


		$check =connect_db()->prepare("SELECT username FROM user WHERE username = :username");
		$check->bindValue(':username', $_POST['username']);
		$check->execute();

		//echo '==='.$check->rowCount();
		if($check->rowCount()> 0){
		  //user exists
		  return false;
		  
		} else {
		  //new user
		  return true;
		  echo "SORRY...YOU ARE ALREADY REGISTERED USER : ".$_POST['username'];
		}
	}

	

			
?>