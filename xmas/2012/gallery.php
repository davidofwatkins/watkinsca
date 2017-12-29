<!doctype html>
<html>
<head>
	<title>Floating Gallery</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script type="text/javascript" src="floating-gallery.js"></script>
	<script type="text/javascript" src="jquery.transit.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script type="text/javascript" src="preloader.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Englebert' rel='stylesheet' type='text/css'>
	<script>
		
		//Gather the picture data
		/*$.getJSON("getslideshowdata.php", function(picturesJSON) {
			
			//Create the gallery
			$(document).ready(function() {
				startShow(picturesJSON);
			});
		});*/
		
		//Change signature color
		$(document).ready(function() {
			var counter = 1;
			setInterval(function() {
				if (counter %2 == 0) { //if counter is even
					$("#goodbye").animate({ color: "#008000" }, 10000);
				}
				else {
					$("#goodbye").animate({ color: "#F00" }, 10000);
				}
				counter++;
			}, 10000);
		});
		
		function startShow(picturesJSON) {
			var gallery = new FloatingGallery("floating-gallery-container", picturesJSON, {
					repeatFrequency: 15000,
					defaultAnimationLength: 3000
				});
		}
		
	</script>
	
	<style>
		* { margin: 0; padding: 0; }
		body {
			overflow: hidden;
			background: black;
			color: white;
			font-family: Tahoma, Geneva, sans-serif;
		}
		
		#floating-gallery-container {
			position: relative;
		}
		
			#floating-gallery-container {
				border: 1px solid transparent;
			}
		
		.fg-galleryitem {
			position: absolute;
			width: 600px;
			height: 500px;
			//border: 1px solid red;
		}
		
		.fg-picture-container {
			display: inline-block;
		}
			.fg-picture-container img {
				border-radius: 5px;
			}
		
		.fg-caption {
			display: inline-block;
			padding: 1%;
			text-align: center;
			font-size: 35px;
			font-family:"Times New Roman", Georgia, Serif;
			font-style: italic;
			vertical-align: top;
		}
		
		.fg-caption img {
			//background: black;
		}
		
		
		/* Preloader */
		#vcenter {
			position: absolute;
			height: 0px;
			width: 100%;
			overflow: visible;
			top: 50%;
		}
		#preloader_container {
			 position: absolute;
			 left: 50%;
			 top: -180px;
			 margin-left: -400px;
			 
			 background-color: #1F1F1F;
			 text-align: center;
			 width: 740px;
			 height: 300px; //540px;
			 padding: 40px;
			 border-radius: 5px;
		}
		
			#preloader_container h1 {
				font-family: Englebert, Tahoma, Geneva, sans-serif;
				font-size: 50px;
			}
			#preloader_container h2 {
				font-family: Englebert, Tahoma, Geneva, sans-serif;
				font-size: 30px;
			}
		
			#spinner {
				margin-top: 30px;
				margin-bottom: 100px;
			}
			
			#loadingtext {
				margin-top: 0px;
				color: white;
				font-size: 16px;
				text-align: center;
				font-weight: bold;
			}
		
		#loadingbar {
			background: darkgrey;
			width: 500px;
			height: 20px;
			border-radius: 10px;
			position: absolute;
			bottom: 50px;
			left: 50%;
			margin-left: -250px;
		}
		
		#loadingjuice {
			background: #4D8A4D;
			width: 0%;
			height: 100%;
			border-radius: 10px;
		}
		
		#playbutton {
			margin: 66px auto;
			padding: 8px 20px;
			background: gray;
			color: white;
			border-radius: 3px;
			font-size: 18px;
			width: 100px;
			display: none;
		}
		
		#preloader_container a {
			text-decoration: none;
		}
		
		#audioplayer-container {
			position: absolute;
			top: -1000px;
			left: -1000px;
		}
		
		#finalslide {
			display: none;
			position: absolute;
			left: 50%;
			top: -265px;
			margin-left: -500px;
			
			background-color: #1F1F1F;
			width: 1000px;
			height: 530px;
			border-radius: 5px;
			overflow: hidden;
		}
		
			#finalslide img#sanfranpic {
				max-height: 100%;
				display: inline-block;
				vertical-align: middle;
				margin-right: 20px;
				box-shadow: 0 0 20px black;
			}
			
			#finalslide #goodbye {
				display: inline-block;
				vertical-align: middle;
				padding-right: 10px;
				max-width: 305px;
				font-family: Englebert, Tahoma, Geneva, sans-serif;
				color: green;
			}
			
				#goodbye #laststanza {
					font-size: 32px;
					margin-bottom: 20px;
				}
				
				#goodbye #signature {
					font-size: 22px;
				}
				
				#goodbye a {
					text-decoration: none;
				}
				
		/* Download button, copied from another css doc */
		.dlpdf {
			width: 190px;
			height: 40px;
			padding-right: 20px;
			padding-left: 10px;
			padding-top: 2px;
			line-height: 38px; /* Essentially vertically centers one line of text - in addition to padding-top*/
			letter-spacing: 1px;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 14px;
			font-weight: 400;
			color: #FFF;
			text-align: right;
			background-color: #344153;
			display: block;
			margin-left: auto;
			margin-right: auto;
			margin-top: 80px;
			margin-bottom: 5px;
			/*border: 1px solid #FFF;*/
			/* CSS3 */
			border-radius: 5px;
			-moz-border-radius: 5px;
			-webkit-border-radius: 5px;
			-khtml-border-radius: 5px; 
		}
		.dlpdf:hover {
			border: 1px solid #525D80;
			margin-bottom: 4px; /* margin-bottom and margin-top are set to 1px less so that the hovered border doesn't cause spacial problems */
			margin-top: 79px;
		}
		.dlpdf img {
			margin: 0;
			padding: 0;
			float: left;
		}
		
	</style>
</head>
<body>
	<div id="floating-gallery-container"></div>
	<div id="vcenter">
		<div id="preloader_container">
			<h1>Remembering 2012 &amp; Those We Love</h1>
			<h2>From the Watkins Family!</h2>
			<img id="spinner" src="spinner.gif" />
			<a href="#" id="playbutton_link"><div id="playbutton">Play Card</div></a>
			<div id="loadingtext">Loading...</div>
			<div id="loadingbar">
				<div id="loadingjuice"></div>
			</div>
		</div>
		
		<div id="finalslide">
			<img id="sanfranpic" src="familyphoto.png" />
			<div id="goodbye">
				<p id="laststanza">May the new year bring us all joy and peace,</p>
				<p id="signature">&mdash;Mary, David, and David O. ("Binks")</p>
				<a href="poem2012.pdf">
					<div class="dlpdf">
						<img src="../../images/PDF.png" alt="PDF" width="48" height="48" nomargin="" />
						Download Poem
					</div>
					<div style="clear: both;"></div>
				</a>
			</div>
			
		</div>
	</div>
	
	<div id="audioplayer-container"><center>
			<small style="color: #000;"><b>Music Controls</b>:</small><br>
			<audio id="audioplayer" controls="" <!--autoplay="true"-->>
				
				<?php echo '<source src="' . $_GET["musicurl"] . '" />'; ?>
				
				<!--<source src="clairdelune.mp3">
				<source src="clairdelune.ogg">-->
				<!--
					Note about OGG files:
					
					It is likely that the server will not recognize the OGG file format.
					Therefore, it may be necessary to create an .htaccess file that assigns a
					MIME type to OGG files, with the following line:
					
						AddType audio/ogg .ogg
						
					This will allow browsers such as Firefox to download the OGG file as media,
					and play it in its HTML5 audio player.
					
					Sample .htaccess file with MIME type declarations, here:
					https://developer.mozilla.org/en/Sample_.htaccess_file
				-->
				<embed type="application/x-shockwave-flash" flashvars="audioUrl=<?php echo $_GET["musicurl"]; ?>&amp;autoPlay=true" src="http://www.google.com/reader/ui/3523697345-audio-player.swf" width="400" height="27" quality="best">
			</audio>
		</center></div>
</body>
</html>