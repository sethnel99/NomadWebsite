
//
//Create the NavBar
//

$('<ul class="nav">\
  <li class="active"><a href="index.php">About</a></li>\
  <li class="active"><a href="team.php">The Team</a></li>\
  <li class="active"><a href="contact.php">Contact</a></li>\
  <li class="active"><a href="truckmap.php">Map</a></li>\
  </ul>').insertAfter('#twitter-sign-in');

//
//Setup icon
//
$('head').prepend('\
		<link rel="shortcut icon" href="images/truck_logo.png" type="image/x-icon" />\
		<link rel="icon" href="images/truck_logo.png" type="image/x-icon" />');
		
		
//
//Slide paragraph in and out of info-boxes
//

$('.info-box').click(function(){
    $(this).find('.slide-paragraph').slideToggle('medium');
});

//
//Highlight title white when hover over with mouse
//

$('.info-box h1').hover(function(){
    $(this).css('color','#EEEEEE');
}, function(){
    $(this).css('color','black');
});

//
//Inintialize the info-boxes
//

$('.slide-paragraph').hide();


//
//Takes the key as an argument and returns the query string
//

function getQuerystring(key, default_)
{
    if (default_==null) default_="";
    key = key.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
    var regex = new RegExp("[\\?&]"+key+"=([^&#]*)");
    var qs = regex.exec(window.location.href);
    if(qs == null)
        return default_;
    else
        return qs[1];
}

//
//Insert edit info boxes button
//

$('<input type="button" value="Edit" class="toggle-edit btn">').insertBefore('.pic-column').first();
$('.edit-data').toggle();
$('.hide-me').toggle();



$('.delete-item').click(
	function(){
		if($(this).val() == 'Delete'){
			$(this).parent().find('.save-delete').first().val('yes');
			$(this).parent().parent().find('.toggle-edit').toggle();
			$(this).parent().find('.submit-menu').first().val('Confirm Delete');
			$(this).val('Cancel');
			
		} else{
			$(this).parent().find('.save-delete').first().val('no');
			$(this).parent().parent().find('.toggle-edit').toggle(); 
			$(this).parent().find('.submit-menu').first().val('Save');
			$(this).val('Delete');
			
		}
	});
	
	
//
//Toggle edit mode
//

$('.toggle-edit').click(function() {
	$(this).parent().find('.fixed-data').toggle();
	$(this).parent().find('.edit-data').toggle();
	
	if ($(this).parent().find('.input-text').first().is(':hidden')) {
		$(this).parent().find('.dl-horizontal dd').css('margin-bottom','20px');
	} else {
		$(this).parent().find('.dl-horizontal dd').css('margin-bottom','0px');
	}
	$(this).toggle();
});

$('#log-out').click(function(){
	$.post('php/logout.php', 
	{logout: 'yes'},
	function(){
		location = 'index.php';
	});
});

//If user owns a business, hide the "Following" information
$('.home-items').hide();
if($('.business-exists').length > 0){
	$('#my-business').show();
} else {
	$('#my-following').show();
	//Have businesses nav button toggle business div
	$('#make-business').click(function(){
	
		$.post('php/createbusiness.php', 
		{id :'123'},
		function(){
			location = 'home.php';
		});
	});
	
}



//have nav-buttons do something

$('#nav-business').click(function(){
	$('.home-items').hide();
	$('#my-business').show();
});

$('#nav-following').click(function(){
	$('.home-items').hide();
	$('#my-following').show();
});

$('#nav-analytics').click(function(){
	$('.home-items').hide();
	$('#my-analytics').show();
});