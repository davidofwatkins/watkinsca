<!DOCTYPE html>
<html>
<head>
	<title>In Loving Memory of Jean Keown</title>
	<link type="text/css" rel="stylesheet" href="style.css" />
	<script type="text/javascript" src="jquery.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
	<script>
		var  textboxlimit = 1000;
		
		$(document).ready(function() {
			
			$("#showmap").click(function(event) {
				event.preventDefault();
				if ($("#map").css("position") == "absolute") {
					$("#map").css({ "display" : "none", "position" : "relative", "top" : "auto", "left" : "auto" });
				}
				toggleMap();
			});
			
			$("#uploadpictures").change(function() {
				showFileListing();
			});
			
			$("textarea#story").focus(function() {
				if ($(this).outerHeight(false) < 100) {
					$(this).animate({ "height" : "100px" }, "fast");
				}
			});
			
			//Limit number of characters in textarea
			$("textarea#story").keydown(function() {
				checkTextareaCharacterLimit($("textarea#story"), textboxlimit)
			});
			
		});
		
		function toggleMap() {
			$("iframe#map").slideToggle("fast",  function() {
				if ($("#showmap .text").html() == "Show Map") {
					$("#showmap .text").html("Hide Map");
				}
				else { $("#showmap .text").html("Show Map"); }
			});
		}
		
		function showFileListing() {
			var input =  document.getElementById("uploadpictures");
			var listContainer = $("#uploadlisting");
			var list = $("#uploadlisting ul");
			
			//Clear list
			list.empty();
			
			//Show listing if files have been chosen
			if (input.files.length >  0) {
				
				//Fill the list
				for (var i = 0; i < input.files.length; i++) {
					list.append("<li>" + input.files[i].name + "</li>");
				}
				
				//Display the container
				listContainer.fadeIn("fast");
			}
			else {
				listContainer.fadeOut("fast");
			}
		}
		
		function validate() {
			
			var possibleError = false;
			
			//Check each UL to make sure they are filled with a valid value
			$("#uploadlisting ul li").each(function() {
				if ($(this).html().toLowerCase().indexOf(".jpg") < 0 && $(this).html().toLowerCase().indexOf(".png") < 0 && $(this).html().toLowerCase().indexOf(".gif")) {
					/*alert("JPG: " + $(this).html().toLowerCase().indexOf(".jpg"));
					alert("PNG: " + $(this).html().toLowerCase().indexOf(".png"));
					alert("GIF: " + $(this).html().toLowerCase().indexOf(".gif"));*/
					if (possibleError == false) { possibleError = true; }
				}
			});
			
			if ($("#name").val() == "") {
				showError("Please enter your name.");
				return false;
			}
			else if (document.getElementById("uploadpictures").files.length == 0 && $("#story").val() == "") {
				showError("Please either select a picture or compose a testimony in the text box.");
				return false;
			}
			else if ($("textarea#story").val().length > textboxlimit) {
				showError("Please shorten your testimony so that it is under " + textboxlimit + " characters");
				return false;
			}
			else if (possibleError == true) {
				showError("Please ensure that each picture you intend to upload is either a JPEG, GIF, or PNG.");
				return false;
			}
			else {
				$("#errormsg").fadeOut();
				$("form input[type=submit]").animate({ "width" : "200px" }, "fast");
				$("form input[type=submit]").css("background", "gray");
				$("form input[type=submit]").attr("value", "Loading, please wait...");
				return true;
			}
		}
		
		function showError(msg) {
			$("#errormsg").fadeOut("fast");
			$("#errormsg").html(msg);
			$("#errormsg").fadeIn("fast");
		}
		
		function checkTextareaCharacterLimit(textarea, limit) {
			
			var value = textarea.val();
			var numChars = value.length;
			
			if (numChars > limit) {
				var newValue = value.substring(0, limit);
				textarea.val(newValue);
			}
		}
		
	</script>
	
	<?php
		if ($_GET["error"]) { echo '<style type="text/css"> form #errormsg { display: block; } </style>'; }
	?>
</head>
<body>
	<div id="left">
		<img src="jean-cropped.jpg" id="photo" />
	</div>
	<div id="right" class="transbackground">
		<h1>In Loving Memory of Jean Keown</h1>
		<p class="description">Please join us in remembering Jean Keown on <b>Sunday, June 10th, 2012</b> at <b>12:30 PM</b> at the Christian Science Society in San Juan Capistrano, where Jean attended church (within walking distance from the train station). Testimonials from the floor will follow spiritual readings and multimedia presentations. If you won't be able to make it in person, you may join the service through teleconference by calling <b>(805) 309-2350</b> (access code 12111#) or through Skype (<a href="http://www.csinsanjuancapistrano.com/">click here for instructions</a>).</p>
		<p><a href="#" id="showmap"><img src="mapsicon.png" id="mapicon" /><span class="text">Show Map</span></a></p>
		
		<iframe id="map" width="600" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=christian+science+san+juan+capistrano&amp;aq=&amp;sll=38.366083,-112.178531&amp;sspn=34.203041,67.631836&amp;t=m&amp;ie=UTF8&amp;hq=christian+science&amp;hnear=San+Juan+Capistrano,+Orange,+California&amp;fll=33.498298,-117.664525&amp;fspn=0.004469,0.008256&amp;st=107182770938709909725&amp;rq=1&amp;ev=zo&amp;split=1&amp;ll=33.498765,-117.665076&amp;spn=0.007157,0.010707&amp;z=16&amp;iwloc=near&amp;output=embed"></iframe>
		
		<div id="submitpicturescontainer">
			<?php if ($_GET["msg"] == "thankyou"): ?>
			<h1>Thank You</h1>
			<p class="description">We have received your submission and will add it to the slideshow at the memorial.</p>
			<?php else: ?>
			<h1>Submit Pictures</h1>
			<form method="post" action="uploader.php" enctype="multipart/form-data" onsubmit="return validate()">
				<p class="description">If you have any photo memories that you would like to share at the memorial service, you can upload them from your computer here, and they will be added to a slideshow at the event.</p>
				<p id="errormsg"><?php if ($_GET["error"]) { echo $_GET["error"]; } ?></p>
				<p class="meta">Your Name:</p>
				<input type="text" id="name" name="uploader_name" placeholder="Please enter your name here" /><br />
				<div id="upload-button">
					<label for="uploadpictures">Select pictures...</label>
					<input type="file" id="uploadpictures" name="uploadedpictures[]" multiple="true" />
				</div>
				<div id="uploadlisting">
					<p>The following pictures will be uploaded:</p>
					<ul>
					</ul>
				</div>
				<p style="margin-top: 40px;">Alternatively, if you will not be available to attend the memorial and leave a testimony in person, you may leave a message that will appear as text on the slideshow:</p>
				<textarea name="story" id="story" placeholder="Please leave a short testimony here."></textarea>
				<input type="submit" value="Done" />
			</form>
			<?php endif; ?>
		</div>
	</div>
	<div style="clear: both"></div>
</body>
</html>