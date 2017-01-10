<html>
	<head>
		<link rel="stylesheet" href="css/style.css" type="text/css">
        <title>Camagru</title>
        </head>
        <body background="Ressources/bgGrey.png">
            <?php include("header.html") ?>
            <table style="border:3px solid red; width:90%; margin:2%">
                <tr style="border:3px solid blue;">
                    <th rowspan="4">
                        <div style="width:700; border:2px solid black;">
                            <video id="video"></video><br/>
                            <button class="cam-button" id="startbutton">Cam<br/>Yourself</button>
                        </div>
                    </th>
                    <th>
                        <p>ICI SERONT MISENT LES IMAGES A CHOISIR</p>
                    </th>
                    <th style="border:3px solid blue;">
                        <canvas id="canvas"></canvas>
                    </th>
                </tr>
            </table>
            <?php include("footer.html") ?>
            <script>
                (function() {
                    var streaming	 = false,
                    video        = document.querySelector('#video'),
                    cover        = document.querySelector('#cover'),
                    canvas       = document.querySelector('#canvas'),
                    photo        = document.querySelector('#photo'),
                    startbutton  = document.querySelector('#startbutton'),
                    width = 700,
                    height = 0;
                    navigator.getMedia = (navigator.getUserMedia ||
                                        navigator.webkitGetUserMedia ||
                                        navigator.mozGetUserMedia ||
                                        navigator.msGetUserMedia);
                    navigator.getMedia(
                    {
                        video: true,
                        audio: false
                    },
                    function(stream) {
                        var vendorURL = window.webkitURL || window.URL;
                        video.src = vendorURL.createObjectURL(stream);
                        video.play();
                    }, function(err) { console.log("An error occured! " + err);}
                    );
                    video.addEventListener('canplay', function(ev){
                        if (!streaming) {
                            height = video.videoHeight / (video.videoWidth/width);
                            video.setAttribute('width', width);
                            video.setAttribute('height', height);
                            canvas.setAttribute('width', width);
                            canvas.setAttribute('height', height);
                            streaming = true;
                        }
                    }, false);
                    function takepicture() {
                        canvas.width = 640;
                        canvas.height = 480;
                        canvas.getContext('2d').drawImage(video, 0, 0, 640, 480);
                        var data = canvas.toDataURL('image/png');
                        //inserer ici la fonction permetant d'enregistrer les images sur la database
                        photo.setAttribute('src', data);
                    }
                    startbutton.addEventListener('click', function(ev){
                        takepicture();
                        ev.preventDefault();
                    }, false);
                }
            )()
        </script>	
    </body>
</html>