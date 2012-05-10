//
//Create the NavBar
//

$('<ul class="nav">\
  <li class="active"><a href="index.php">Home</a></li>\
  <li class="active"><a href="about.php">About</a></li>\
  <li class="active"><a href="contact.php">Contact</a></li>\
  <li class="active"><a href="truckmap.php">Map</a></li>\
  </ul>').insertAfter('#twitter-sign-in');


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

$('<input type="button" value="Edit" class="toggle-edit">').insertBefore('.pic-column').first();
$('.edit-data').toggle();
$('.hide-me').toggle();


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