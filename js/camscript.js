                 (function() {
                    var streaming    = false,
                    video        = document.querySelector('#video'),
                    cover        = document.querySelector('#cover'),
                    canvas       = document.querySelector('#canvas'),
                    photo        = document.querySelector('#photo'),
                    startbutton  = document.querySelector('#startbutton'),
                    width = 640,
                    height = 480;
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
                        canvas.width = width;
                        canvas.height = height;
                        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
                        var filter = document.getElementById('filter').src;
                        var data = canvas.toDataURL('image/png');
                        var f = document.createElement("form");
                        f.method = 'post';
                        f.action = './func/DBsetimg.php';
                        var nImg = document.createElement("input");
                        nImg.name = 'data';
                        nImg.value = data;
                        var nFilter = document.createElement("input");
                        nFilter.name = 'filter';
                        nFilter.value = filter; 
                        f.appendChild(nImg);
                        f.appendChild(nFilter);
                        document.body.appendChild(f);
                        f.submit();
                    }
                    startbutton.addEventListener('click', function(ev){
                        takepicture();
                        ev.preventDefault();
                    }, false);
                }
            )();