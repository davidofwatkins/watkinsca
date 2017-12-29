<!DOCTYPE html>
<html>
<head>
    <title>Remembering Jean Keown</title>
    <script type="text/javascript" src="../jquery.js"></script>
    <script type="text/javascript" src="jquery.imagesloaded.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: black;
            color: white;
            font-family: "Times New Roman", serif;
        }
        
        #slideshow {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            display: inline-block;
            vertical-align: middle;
        }
        
        #slideimage {
            display: block;
            margin: 0 auto;
        }
        
    </style>
    
    <script>
        
        var path = "../uploads/";
        var pictures = new Array("1.jpg", "2.jpg", "3.png", "4.png", "5.png");
        
        $(document).ready(function() {
            
            $("#preloading img").imagesLoaded(function() {
                startSlideshow();
            });
            
            //startSlideshow();
        });
        
        function startSlideshow() {
            
            $("#slideshow").append('<img id="slideimage" style="display: none;" />');
            
            $("#slideimage").css({
                "max-width" : $(document).width(),
                "max-height" : $(document).height()
            });
            
            var counter = 0;
            
            showSlide(counter);
            counter++;
            
            loop();
            function loop() {
                    setTimeout(function() {
                        
                        showSlide(counter);
                        counter++;
                        if (counter + 1 <= pictures.length) { loop(); }
                    }, 7000);
            }
        }
        
        function showSlide(num) {
            
            var slideImage = $("#slideimage");
            slideImage.fadeOut("slow", function() {
                
                slideImage.attr("src", path + pictures[num]);
                slideImage.fadeIn(900);
            });
            
        }
        
    </script>
</head>
<body>
    <div id="preloading" style="display: none;">
        <img src="../uploads/1.jpg" />
        <img src="../uploads/2.jpg" />
        <img src="../uploads/3.png" />
        <img src="../uploads/4.png" />
        <img src="../uploads/5.png" />
    </div>
    <div id="slideshow"></div>
</body>
</html>