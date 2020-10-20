// JavaScript Document
$(document).ready(function () {
    startSlideshow();
});

var nextSlideNum = 0;

var slides = new Array(
    //Snowy Champlain
    new Array(
        'Champlain College',
        'binks-hotchocolate-snow.jpg',
        'snowy-champlain.jpg',
        'antigone-cover.jpg',
        'snowy-walkway.jpg'
    ),
    //KKD 1a
    new Array(
        'Marks Winter Visit',
        "Disney-Kayla-Mary-Mickey's-table.jpg",
        'Crescent-Beach.jpg',
        'karen-dad1.jpg',
        'Legoland-Mary-Dave.jpg'
    ),
    //KKD 1b
    new Array('^', 'binks-skype.jpg', 'binks-skype2.jpg', 'dad-kayla1.jpg', 'dad-kayla2.jpg'),
    //Award, Quilt, Guitar
    new Array('Creativity', 'award.jpg', 'quilt.jpg', 'binksguitar1.jpg', 'guitar-back.jpg'),
    //Bogie 1
    new Array('Bogie In', 'bogie-tongue2.jpg', 'bogiebunny.jpg', 'bogie-binks-guitar.jpg', 'bogie-sleeping.jpg'),
    //Bogie 2
    new Array(
        'Bogie Out',
        'binks-pushing-bogie.jpg',
        'bogie-tongue.jpg',
        'karen-kayla-walking.jpg',
        'binks-walking-bogie.jpg'
    ),
    //KKD 2a
    new Array(
        'Marks Summer Visit',
        'kayla-bogie.jpg',
        'kayla-binks-bogie-car.jpg',
        'dad-karen2.jpg',
        'dinner-at-bay.jpg'
    ),
    //KKD 2b (Beach)
    new Array('^', 'beach1.jpg', 'beach3.jpg', 'beach2.jpg', 'beach4.jpg'),
    //KKD 2c
    new Array('^', 'kayla-hopscotch.jpg', 'karen-hopscotch.jpg', 'kayla-mom-fort.jpg', 'david-kayla-fort.jpg'),
    //KKD 2d
    new Array('^', 'binks-kayla-karen-boat-ride.jpg', 'catalina2.jpg', 'catalina-car.jpg', 'binks-wild-hair.jpg'),
    //KKD 2e (4h of July)
    new Array('4th of July', 'fourth-cutting-cake.jpg', 'gram-fourth.jpg', 'hot-tub-fourth.jpg', 'kayla-candle.jpg'),
    //Gram's Birthday
    new Array(
        "Jean's Birthday",
        'riviera.jpg',
        'binks-playing-guitar-for-family.jpg',
        'binks-diana.jpg',
        'mom-sally-gram-brucie.jpg'
    ),
    //Gram
    new Array('Jean', 'gram1.jpg', 'gram4.jpg', 'gram2.jpg', 'gram3.jpg'),
    //49rs, Fathers day, etc.
    new Array('Down Time', 'dad-49ers2.jpg', 'Kayla-SF.jpg', 'fathersday.jpg', 'inthesun.jpg'),
    //Friends
    new Array('Friends &amp; Family', 'momjoaniebabs.jpg', 'tinamombinks.jpg', 'mombinksbench.jpg', 'mom-joni.jpg'),
    //Montreal Arrival
    new Array('To Montreal', 'customs.jpg', 'travelling.jpg', 'binks-dad-restaurant.jpg', 'binks-mom-bike.jpg'),
    //Parents Quebec 1
    new Array('Quebec City', 'dad-raincoat.jpg', 'mom-quebec-street.jpg', 'mom-dad-dinner.jpg', 'cds.jpg'),
    //Parents Quebec 2
    new Array('^', 'floating-statue.jpg', 'quebec-street-5.jpg', 'quebec-street2.jpg', 'quebec-street1.jpg'),
    //Champlain Montreal
    new Array('Champlain Montreal', 'champlain-logo.jpg', 'campus.jpg', 'uqam.jpg', 'view-from-dorm.jpg'),
    //Montreal 1
    new Array('^', 'binks-restaurant.jpg', 'old-port-street.jpg', 'sunset-montreal.jpg', 'mtroyal-group1.jpg'),
    //Montreal 2
    new Array('^', 'mountroyal.jpg', 'street.jpg', 'all-group1.jpg', 'double-pizza.jpg'),
    //Montreal 3
    new Array('^', 'olympic-tower.jpg', 'roomamte-moustaches.jpg', 'roommate-moustaches2.jpg', 'metro-cars.jpg'),
    //Montreal 4
    new Array(
        '^',
        'old-port-statue1.jpg',
        'notre-dame-day.jpg',
        'old-port-cirque-du-soleil.jpg',
        'old-port-statue2.jpg'
    ),
    //Montreal 5
    new Array('^', 'bike.jpg', 'apartments.jpg', 'plants-door.jpg', 'quebec-street-with-flowers.jpg'),
    //Montreal 6 (dark)
    new Array('^', 'mr-view-dark.jpg', 'amusement-park-group.jpg', 'hockey-game.jpg', 'thanksgiving-group.jpg'),
    //Quebec 1
    new Array('Quebec City', 'quebec-view.jpg', 'quebec-looking-over.jpg', 'quebec-group2.jpg', 'quebec-group1.jpg'),
    //Quebec 2
    new Array('^', 'frontenac.jpg', 'quebec-flags.jpg', 'cannon.jpg', 'quebec-view2.jpg'),
    //Quebec 3
    new Array('^', 'quebec-street-6.jpg', 'quebec-horse.jpg', 'wall-painting.jpg', 'quebec-street4.jpg'),
    //Ottawa
    new Array('Ottawa', 'parliament.jpg', 'parliament-library-roof.jpg', 'quebec-group-night.jpg', 'library-group.jpg'),
    //Gram Support
    new Array(
        'Support for Jean',
        'gram-joanie-babs.jpg',
        'ahernswithgram.jpg',
        'marta-visit-gram.jpg',
        'sallygramwhites.jpg'
    ),
    //MD Visit
    new Array('David &amp; Kids', 'dad-md2.jpg', 'dadkaylathanksgiving.jpg', 'dad-reading-to-kayla.jpg', 'dad-md1.jpg'),
    //Bogie Support
    new Array(
        'Support for Bogie',
        'gram-with-bogie.jpg',
        'lamiece-bogie.jpg',
        'bogie-jacuzzi.jpg',
        'bogie-and-buffy.jpg'
    ),
    //Montreal Xmas 1
    new Array(
        'Christmas is Coming',
        'lanterns.jpg',
        'roommate-hats.jpg',
        'Eaton-Xmas-Decorations.jpg',
        'fountains.jpg'
    ),
    //Montreal Xmas 2
    new Array('^', 'oldport-lights.jpg', 'stars.jpg', 'notre-dame.jpg', 'old-building-street.jpg'),
    //Xmas
    new Array('^', 'fireplace-xmas.jpg', 'xmastree-lighted.jpg', 'xmas-window.jpg', 'xmas-dark-outside.jpg'),
    //Xmas 2
    new Array('Christmas Day', 'stairs-xmas.jpg', 'xmas-livingroom.jpg', 'xmastree-bogie.jpg', 'xmastree.jpg'),
    //Xmas - Bogie Bone
    new Array('^', 'bogiebonexmas.jpg', 'bogie-bone-xmas.jpg', 'eatingoutside.jpg', 'gram-xmas-toast.jpg'),
    //Sunsets
    new Array('The Birth of a New Year', 'laguna-view.jpg', 'laguna-view2.jpg', 'lagunarocks.jpg', 'laguna-view3.jpg'),
    //Closing
    new Array(
        'The End <small style="font-size: 14px;">(<a href="index.html">Replay</a>)</small>',
        'closinga.jpg',
        'closingb.jpg',
        'closingc.jpg',
        'closingd.jpg'
    )
);

function startSlideshow() {
    nextSlideNum = 0;
    var numSlides = slides.length;
    var counter = 1;

    loop();
    function loop() {
        setTimeout(function () {
            nextSlide();
            counter++;
            if (counter <= numSlides) {
                loop();
            }
        }, 7000);
    }
}

function nextSlide() {
    //delayed:
    loop();
    var j = 1;
    function loop() {
        setTimeout(function () {
            swapImages('container' + j, slides[nextSlideNum][j]);
            j++;
            if (j <= 4) {
                loop();
            } else {
                updateText(function () {
                    nextSlideNum = nextSlideNum + 1;
                    //Preload next set of pictures
                    preloadUpcomingSlide();
                });
            }
        }, 400);
    }

    //All at once:
    /*for (i = 1; i <= 4; i++) {
		swapImages("container" + i, slides[nextSlideNum][i]);
	}*/

    //Sequentional:
    /*swapImages("container1", slides[nextSlideNum][1], function() {
		swapImages("container2", slides[nextSlideNum][2], function() {
			swapImages("container3", slides[nextSlideNum][3], function() {
				swapImages("container4", slides[nextSlideNum][4]);
			});
		});
	});*/
}

function swapImages(containerId, newImage, callback) {
    //Simple switch
    //$("#" + containerId + " img").attr("src", "images/" + newImage);

    //Fading transition
    $('#' + containerId).append('<img src="images/' + newImage + '" style="display: none;" />');
    $('#' + containerId + ' img:nth-child(2)').fadeIn('slow', function () {
        $('#' + containerId + ' img:nth-child(1)').remove();
        if (callback != null) {
            callback();
        }
    });
}

function updateText(callback) {
    var newText = slides[nextSlideNum][0];
    if (newText != '^') {
        var container = $('#description-container');
        container.fadeOut('fast', function () {
            container.html(newText);
            container.fadeIn('fast');
            callback();
        });
    } else {
        callback();
    }
}

function preloadUpcomingSlide() {
    if (nextSlideNum < slides.length) {
        var images = slides[nextSlideNum];
        preloadImages([images[1], images[2], images[3], images[4]]);
    }
}

function preloadImages(arrayOfImages) {
    $(arrayOfImages).each(function () {
        //Will take callback
        $('<img/>')[0].src = 'images/' + this;
        // Alternatively you could use:
        // (new Image()).src = this;
    });

    //Usage: (perhaps use PHP to generate list of images in each directory?)
    /*preload([
		'img/imageName.jpg',
		'img/anotherOne.jpg',
		'img/blahblahblah.jpg'
	]);*/
}
