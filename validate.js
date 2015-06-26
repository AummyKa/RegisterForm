
function validateForm() {

    var name = document.forms["content"]["name"].value;
    var lastname = document.forms["content"]["lastname"].value;
    var username = document.forms["content"]["username"].value;
    var password = document.forms["content"]["password"].value;
    var sex = document.forms["content"]["sex"].value;
    var b_date = document.forms["content"]["date_of_birth"].value;
    
    var itr = document.getElementsByName("interest[]");
	
	var check_var = false;
    var msg = '';
	var unchecked_count =0;


	for (var i = 0; i < itr.length; i++)
	{
		if (itr[i].checked){
         break;
		} 
        else unchecked_count++;
	}
	
		if(unchecked_count==itr.length){
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
    if (sex == null || sex == "") {
         msg +="\n sex must be filled out";
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