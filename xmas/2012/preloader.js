var originalPicturesJSON;

$(document).ready(function() {
	$.getJSON("getslideshowdata.php", function(picturesJSON) {
		
		originalPicturesJSON = picturesJSON;
		var pictures = filterArray(picturesJSON);
		preloadImages(pictures);
	});
});

function filterArray(picturesJSON) {
	var pictures = new Array();
	for (var i = 0; i < picturesJSON.length; i++) {
		for (var j = 0; j < picturesJSON[i]["images"].length; j++) {
			pictures.push(picturesJSON[i]["images"][j]);
		}
	}
	return pictures;
}

var numLoaded = 1;
function preloadImages(images) {
	for (var i = 0; i < images.length; i++) {
		var newImage = $('<img src="' + images[i] + '" />');
		newImage.load(function() {
							
			var percent = (numLoaded / images.length) * 100;
			//console.log("Image loaded: " + percent + "%");
			updateLoadingBar(percent);
			numLoaded++;
			
			if (percent == 100) {
				loadFinished();
			}
		});
	}
}

function updateLoadingBar(percent) {
	$("#loadingjuice").stop();
	$("#loadingjuice").animate({ width: percent + "%" }, 500);
}

function loadFinished() {
	
	$("#spinner, #loadingtext").fadeOut("slow", function() {
		$("#playbutton").fadeIn("slow");
	});
	
	$("#playbutton_link").click(function() {
		
		//Remove the preload box
		$("#vcenter").fadeOut("slow", function() {
			
			//Begin the show!
			startShow(originalPicturesJSON);
		});
		
		return false;
	});
}