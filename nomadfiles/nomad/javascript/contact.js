function emailSubmit(){
    var x=document.forms["emailform"]["email"].value;
    var atpos=x.indexOf("@");
    var dotpos=x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
    {
	document.getElementById('success').innerHTML = "Please enter a valid email address.";
	document.getElementById('success').style.visibility = 'visible';
	return false;
    }
	
    $.ajax({
	type: "POST",
	url: "http://174.129.199.73/addemail.php",
	data: {
            email: $("#email").val()
	},
	success: function (data) {
	$('#success').html(data);
	}
    });  // end Ajax
	  
    document.getElementById('success').style.visibility = 'visible';	
	return false;
    }