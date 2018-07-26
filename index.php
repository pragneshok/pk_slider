<!DOCTYPE html>
<html>
    <head>
        <title>Video Slider</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.2/jquery.js"></script>
        <link href="css/pk_slider.css" type="text/css" rel="stylesheet" />
        <script src="js/pk_slider.js" type="text/javascript"></script>
    </head>

    <body>
        <div class="prev">Prev</div>
        <div class="next">Next</div>
        <div class='slider_container'>
            
            <div class="slider imageClass current" style="display: block;">
                <div class="image_bg" attr-url='media/one.jpg'></div>
            </div>

            <div class="slider imageClass" style="display: none;">
                <div class="image_bg" attr-url='media/images.jpg'></div>
            </div>
            
            <div class="slider" style="display: none;">
                <video class="videoClass">
                    <source src="media/1482302555.mp4" type="video/mp4">
                </video>
            </div>
            
        </div>
    </body>
</html>
