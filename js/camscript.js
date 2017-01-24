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
                        var filter = document.getElementById('filter').src;
                        var data = canvas.toDataURL('image/png');
                        var f = document.createElement("form");
                        f.setAttribute('method',"post");
                        f.setAttribute('action',"./func/DBsetimg.php");
                        var nImgIn = document.createElement("input");
                        nImgIn.setAttribute('type',"text");
                        nImgIn.setAttribute('name', 'data');
                        var nImg = document.createElement("input");
                        nImg.setAttribute('type',"text");
                        nImg.setAttribute('name', 'data');
                        nImg.setAttribute('value', data);
                        var nFilterIn = document.createElement("input");
                        nFilterIn.setAttribute('type',"text");
                        nFilterIn.setAttribute('name', 'filter');
                        var nFilter = document.createElement("input");
                        nFilter.setAttribute('type',"text");
                        nFilter.setAttribute('name', 'filter');
                        nFilter.setAttribute('value', filter);
                        f.appendChild(nImgIn);
                        f.appendChild(nImg);
                        f.appendChild(nFilterIn);
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