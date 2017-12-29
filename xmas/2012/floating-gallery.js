//Define defaults - user settings will override these:
var repeatFrequency = 5000;
var defaultAnimationLength = 10000;
var container;
var pictures;
var pictures_runnerUp = 0;
var captionWidth = 500;

//Constructor for the FloatingGallery object
function FloatingGallery(containerID, picturesJSON, options) {
	
	//Save options passed in by user
	repeatFrequency = options["repeatFrequency"];
	defaultAnimationLength = options["defaultAnimationLength"];
	container = $("#" + containerID);
	pictures = picturesJSON;
	
	//Set up the "environment" (#floating-gallery-container)
	resizeContainer();
	$(window).resize(function() {
		resizeContainer();
	});
	
	function resizeContainer() {
		container.height($(window).height());
		container.width($(window).width());
	}
	
	startSlideshow();
}

function startSlideshow() {
	
	//Begin playing HTML5 music
	try {
		document.getElementById('audioplayer').play();
	}
	catch(e) { Console.log("HTML5 player not working"); }
	
	var counter = 0;
	imagedata = getNextImageSet();
	animateNextGalleryItem(imagedata.images, imagedata.caption, imagedata.length);
	(function loopsiloop() {
		var delay = pictures[counter].length;// - (pictures[counter].length * 0.25);
		setTimeout(function(){
			imagedata = getNextImageSet();
			if (imagedata === undefined) {
				//alert("slideshow over");
				showEnd();
				return false;
			}
			
			animateNextGalleryItem(imagedata.images, imagedata.caption, imagedata.length);
			counter++;
			loopsiloop();
		}, delay);
	}) ();
}

//function animateNextGalleryItem(picsrcs, caption, length) {
function animateNextGalleryItem(picturesset, captionPath, length) {

	//Create gallery item within container
	var galleryItem = $('<div class="fg-galleryitem"></div>');
	
	picsrc = picturesset[0];
	
	//Sub-Slideshow
	//var imgSwitchDelay = (length * 0.65) / picturesset.length;
	var imgSwitchDelay = length / picturesset.length;
	var switchCounter = 1;
	setInterval(function() {
		if (typeof picturesset[switchCounter] != "undefined") {
			var thisCounter = switchCounter; //Not sure why we can't just use switchCounter in fadeOut callback below, but whatever.
			galleryItem.children(".fg-picture-container").children("img").animate({ opacity: 0 }, "slow", function() {
				galleryItem.children(".fg-picture-container").children("img").attr("src", picturesset[thisCounter]);
				galleryItem.children(".fg-picture-container").children("img").animate({ opacity: 1 }, "slow");
			});
			switchCounter++;
		}
	}, imgSwitchDelay);
	
	galleryItem.appendTo(container);
	
	//If there is a picture, fill it with that
	if (picsrc != "") {
		galleryItem.append('<div class="fg-picture-container"><img src="' + picsrc + '" /></div>');
		//Set picture sizes
		//var image = $(".fg-picture-container img").last();
		var image = galleryItem.children(".fg-picture-container").children("img");
		var imageWidth;
		var imageHeight;
		var imageLoaded = false;
		
		image.load(function() { //need to "load" the image before finding its width/height
			if (imageLoaded == false) {
				imageLoaded = true;
				
				imageWidth = image.width();
				imageHeight = image.height();
				
				if (imageWidth <= imageHeight) { //If image is tall
					image.css("height", "100%"); //Set image height to height of galleryItem;
					
					//Need to define both width and height for FF :(
					galleryItem.children(".fg-picture-container").css("height", "100%");
					galleryItem.width(image.width() + captionWidth); //Extend the galleryItem for room for caption
					var imgWidthPercent = 100 * image.width() / galleryItem.width();
					galleryItem.children(".fg-picture-container").css("width", imgWidthPercent + "%"); //set the parent's width
					image.css("width", "100%"); //set image width to 100% of parent (.fg-picture-container)
					
					//Caption
					if (galleryItem.children(".fg-caption").length == 0) { //If the caption does not already exist
						galleryItem.append('<div class="fg-caption"><img src="' + captionPath + '" style="width: 100%; max-height: 100%; margin-top: 20%;" /></div>');
						var captionWidthAsPercent = 100 * captionWidth / galleryItem.width();
						galleryItem.children(".fg-caption").width((captionWidthAsPercent - 2) + "%");
						galleryItem.children(".fg-caption").height("95%");
						galleryItem.children(".fg-caption").children("img").width("90%");
						galleryItem.children(".fg-caption").children("img").css("margin-left", "-35px");
					}
					
					//When the caption image has also loaded, start animating the slide!
					galleryItem.children(".fg-caption").children("img").load(function() {
						startAnimation(galleryItem, length, targetLeft, targetTop);
					});
				}
				else { //If image is wide
					image.css("width", "100%");
					
					//Caption
					if (galleryItem.children(".fg-caption").length == 0) { //If the caption does not already exist
						galleryItem.append('<div class="fg-caption"><img src="' + captionPath + '" style="width: 100%;" /></div>');
						galleryItem.children(".fg-caption").width("98%");
						galleryItem.children(".fg-caption").children("img").css("margin-top", "-15px");
						galleryItem.children(".fg-caption").children("img").width("80%");
					}
					
					//When the caption image has also loaded, start animating the slide!
					galleryItem.children(".fg-caption").children("img").load(function() {
					
						galleryItem.height(image.height() + galleryItem.children(".fg-caption").children("img").height());
						startAnimation(galleryItem, length, targetLeft, targetTop);
					});
				}
				
			} //end if imageLoaded == false
		});
	}
	
	var location = getStartPos(galleryItem);
	var targetTop = location["endtop"];
	var targetLeft = location["endleft"]
	
	galleryItem.css({
		top: location["top"],
		left: location["left"],
		display: "none",
		//background: get_random_color()
	});
	
	//Create it off-screen to see how
	
	//Voila! Show the image
	galleryItem.fadeIn("slow");
}

function startAnimation(galleryItem, length, endLeft, endTop) {
	var targetWidth = galleryItem.width() * 0.7;
	var targetHeight = galleryItem.height() * 0.7;
	
	console.log(" => " + endLeft + "x" + endTop);
	
	//var endLocation = getStartPos();
	galleryItem.animate({
		//top: endLocation["top"],
		//left: endLocation["left"],
		top: endTop + "px",
		left: endLeft + "px"
		//width: targetWidth,
		//height: targetHeight
	//}, { queue: false, duration: length });
	}, length);
	
	setTimeout(function() {
		console.log("fading out");
		//galleryItem.fadeOut("slow", function() {
		galleryItem.animate({ opacity: 0 }, { queue: false, duration: "slow" }, function() {
			galleryItem.remove();
		});
	}, length - 2000);
}

//Gets a starting position off-screen to the left, right, top, or bottom
function getStartPos(galleryItem) {
	
	var windowWidth = $(window).width();
	var windowHeight = $(window).height();
	
	//Choose top, bottom, left, or right
	var sideChoice = getRandom(0, 1);
	var top;
	var left;
	var endTop;
	var endLeft;
	
	var itemWidth = galleryItem.outerWidth(true) + 300;
	var itemHeight = galleryItem.outerHeight(true) + 200;
	
	//left
	if (sideChoice == 0) {
		left = 100;
		top = getRandom(100, windowHeight - itemHeight);
		endLeft = windowWidth - (itemWidth + 100);
		endTop = getRandom(100, windowHeight - itemHeight);
	}
	
	//right
	else if (sideChoice == 1) {
		left = windowWidth - (itemWidth + 100);
		top = getRandom(100, windowHeight - itemHeight);
		endLeft = 100;
		endTop = getRandom(100, windowHeight - itemHeight);
	}
	
	//console.log("Starting: " + left + "x" + top + " => " + endLeft + "x" + endTop);
	
	var answer = new Array();
	answer["top"] = top;
	answer["left"] = left;
	answer["endtop"] = endTop;
	answer["endleft"] = endLeft;
	
	//alert(left + "x" + top + " => " + endLeft + "x" + endTop);
	//alert("Top: " + top + " to " + endTop);
	//console.log("windowHeight - itemHeight = " + (windowHeight - itemHeight));
	
	return answer;
}

function getNextImageSet() {
	var nextPic = pictures[pictures_runnerUp];
	pictures_runnerUp++;
	return nextPic;
}
 
function getRandom(lowest, largest) { //(Inclusive)
	largest = largest - lowest;
	largest = largest + 1
	return Math.floor((Math.random() * largest) + lowest);
}

//Temporary, just using as demo
function get_random_color() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.round(Math.random() * 15)];
    }
    return color;
}

function elementInDocument(element) {
	while (element = element.parentNode) {
		if (element == document) {
			return true;
		}
	}
	return false;
}


function showEnd() {
	$("#preload_container").hide();
	$("#finalslide").show();
	$("#vcenter").fadeIn("slow");
}

//Deprecated!
//Returns array of (top, left) coordinates
/*function getRandomStartingPos() {
	
	//temp for testing
	//return getStartPos();
	
	var totalWidth = $(window).width();
	var totalHeight = $(window).height();
	
	//Initial width is 600 x 656
	var left = Math.abs(Math.floor((Math.random() * totalWidth) - 900) + 1);
	var top = Math.abs(Math.floor((Math.random() * totalHeight) - 750) + 1);
	
	while (left + 900 > totalWidth) {
		left = left - 10;
	}
	
	while (top + 750 > totalHeight) {
		top = top - 10;
	}
	
	//console.log("window width: " + totalWidth + "; window height: " + totalHeight);
	//console.log("        top: " + top + "\nleft: " + left + "        right: " + (left + 700) + "\n        bottom: " + (top + 700));
	left = Math.abs(left);
	top = Math.abs(top);
	
	var answer = new Array();
	answer["top"] = top;
	answer["left"] = left;
	
	return answer;
}

//Deprecated!
function getCenterPos() {
	
	//return getStartPos();

	var totalWidth = $(window).width();
	var totalHeight = $(window).height();
	
	var answer = new Array();
	answer["top"] = totalHeight * 0.5;
	answer["left"] = totalWidth * 0.5;
	
	return answer;
}*/



