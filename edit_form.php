

<?php



		include('connect_database.php');

		$con = connect_db();
		$table = "user";
		$id = $_GET['id'];
		// data insert code starts here.
		if(isset($id))
		{
		 $sql = $con->prepare("SELECT * FROM user WHERE id = ?");
		 $sql->bindValue(1, $id);
		 $sql->execute();

		 $result = $sql->fetchAll();
		//print_r($result);die();
		}
		// data update code starts here.
		if(isset($_POST['btn-update']))
		{
		 $id=$_GET["id"];
		 //echo 'id==='.$id; exit();
		 $conn = connect_db();

				$sql = "UPDATE user SET 
	            name = :name, 
	            lastname = :lastname,  
	            username = :username,  
	            password = :password,
	            date_of_birth = :b_date,
	            sex = :sex,
	            interest = :interest
	            WHERE id = :id";

			// new data
			
			// query
			
			$q = $conn->prepare($sql);

			$q->execute(array(
				":name" => $_POST["name"], 
				":lastname" =>$_POST["lastname"], 
				":username" =>$_POST["username"], 
				":password" =>$_POST['password'], 
				":sex" =>$_POST["sex"],
				":b_date" =>$_POST["date_of_birth"],
				":interest" => implode(",",$_POST["interest"]),
				":id" =>$_GET["id"]
				));
		 
		 if($q)
		 {
		  ?>
		  <script>
		  alert('Record updated...');
		        window.location='update-form.php'
		        </script>
		  <?php
		 }
		 else
		 {
		  ?>
		  <script>
		  alert('error updating record...');
		        window.location='update-form.php'
		        </script>
		  <?php
		 }
		}
		// data update code ends here.

		?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    
        

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <!-- import your css file by coping the <link href="yourcssfilename.css" rel="stylesheet"> and paste it under this comment -->
    <!-- http://designmodo.com/audio-player/ -->


    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="css/myCss.css" rel="stylesheet">


    <!-- Loading Flat UI -->
    <link href="css/flat-ui.css" rel="stylesheet">

    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

	</head>


		<body>
		

		
		 

		 <div id="content">
				
		<form id='edit_form' onsubmit="edit_form.php" method='post' accept-charset='UTF-8'>   
		    
		    <fieldset >
				<h font-size = '40px'><legend>Register</legend></h>
			<input type='hidden' name='submitted' id='submitted' value='1'/></h></br>
				
				<h><label for='name' >First Name: </label></h>
				<input type='text' name='name' id='name' maxlength="50" value= "<?php echo $result[0]['name']; ?>" /></h></br></br>

				<h><label for='lastname' >Last Name: </label>
				<input type='text' name='lastname' id='lastname' maxlength="50" value="<?php echo $result[0]['lastname']; ?>" /></h></br></br>
 				
 				<h><label for='username' >UserName:</label>
				<input type='text' name='username' id='username' maxlength="50" value="<?php echo $result[0]['username']; ?>" /></h></br></br>
	
				<h><label for='password' >Password :</label>
				<input type='password' name='password' id='password' maxlength="50" value="<?php echo $result[0]['password']; ?>" /></h></br></br>

				<h><label for='Sex' >Sex :</h></label>
					<input type="radio" name="sex" value="Male" <?php echo ($result[0]['sex']== "male" ? 'checked' : '');?>> Male 
					<input type="radio" name="sex" value="Female"<?php echo ($result[0]['sex']== "female" ? 'checked' : '');?>> Female 
				</br></br>

				<h><label for='Birthday' >Birthday :</h></label>
				<input type="date" name="date_of_birth" value = <?php echo date('Y-m-d',strtotime($result[0]['date_of_birth'])) ?>></br></br>

				<h><label for='Interest' >Interest :</h></label>
					<input type="checkbox" name="interest[]" value="Games"
					<?php 
					if (strpos($result[0]['interest'],'Games') !== false) {
    					echo 'checked';
    					};?>>Games
					<input type="checkbox" name="interest[]" value="Sport"
					<?php 
					if (strpos($result[0]['interest'],'Sport') !== false) {
    					echo 'checked';
    					};?>>Sport
					<input type="checkbox" name="interest[]" value="Music" 
					<?php 
					if (strpos($result[0]['interest'],'Music') !== false) {
    					echo 'checked';
    					};?>>Music 
				</h></br></br>
														
				<button type="submit" name="btn-update"><strong>UPDATE</strong></button></td>
				
 
		</fieldset>
	</form>
		    </table>
	</div>
</body>	   
		    
		<!-- Load JS here for greater good =============================-->
   	
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/jquery.ui.touch-punch.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/bootstrap-switch.js"></script>
    <script src="js/flatui-checkbox.js"></script>
    <script src="js/flatui-radio.js"></script>
    <script src="js/jquery.tagsinput.js"></script>
    <script src="js/jquery.placeholder.js"></script>

    <!-- it works the same with all jquery version from 1.x to 2.x -->
    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <!-- use jssor.slider.mini.js (39KB) or jssor.sliderc.mini.js (31KB, with caption, no slideshow) or jssor.sliders.mini.js (26KB, no caption, no slideshow) instead for release -->
    <!-- jssor.slider.mini.js = jssor.sliderc.mini.js = jssor.sliders.mini.js = (jssor.core.js + jssor.utils.js + jssor.slider.js) -->
    <script type="text/javascript" src="js/jssor.core.js"></script>
    <script type="text/javascript" src="js/jssor.utils.js"></script>
    <script type="text/javascript" src="js/jssor.slider.js"></script>


    <script type="text/javascript">

	function edit_id(id)
	{
	 if(confirm('Sure to edit this record ?'))
	 {
	  window.location='edit_form.php?edit_id='+id
	 }
	}
	</script>
	<script src="validate.js"></script>


</script>
  </body>
</html>


