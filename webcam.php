<!DOCTYPE html>
<html>
    <head>
        <title>Webcam</title>
        <meta charset="utf-8">
    <meta name="description" content="example">
    <title>Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" media="all" />
    </head>
</html>
                <form style="text-decoration-style:none" action="config/logout.inc.php" method="post">
                    <button style="width:90px;float:right;font-size:20px"type="submit" name="logout-submit"><a href="index.php">Logout</a></button>
                </form>
<body>

    <div class="video-wrap">
        <video id="video" autoplay poster="uploads/camera.png"></video>
    </div> 
   <!-- Trigger canvas web API -->
    <div class="controller">
        <button id="snap">Capture</button>
    </div>
    <form action="savecam.php" method="POST">
        <input type="hidden" id="image" name="img">
        <ul>
			<li><label><img style="width: 100px;" onclick="merge(100,80,'./uploads/alphatest1.png')" src="uploads/alphatest1.png"></label></li>
			<li><label><img style="width: 100px;" onclick="merge(40,80,'./uploads/alphatest2.png')" src="uploads/alphatest2.png"></label></li>
			<li><label><img style="width: 100px;" onclick="merge(100,80,'./uploads/alphatest3.png')" src="uploads/alphatest3.png"></label></li>
		</ul>
        <button onclick="save()" id="submit" name="upload">SAVE</button>
    </form>

    <!-- Webcam video snapshot -->
    <canvas id="canvas" width="200" height="100"></canvas>

    <script>
      
      'use strict';
      
      const video = document.getElementById('video');
      const canvas = document.getElementById('canvas');
      const snap = document.getElementById('snap');
      const erorrMsgElement = document.getElementById('span#ErrorMsg');

      const constraints = {
          audio: false,
          video:{
              width: 200, height: 100
          }
      };
      
      // Access webcam
      async function init(){
          try{
              const stream = await navigator.mediaDevices.getUserMedia(constraints);
              handleSuccess(stream);
          }
          catch(e){
              erorrMsgElement.innerHTML = `navigator.getUserMedia.error:{$(e.toString())}`;
          }
      }

      // success
      function handleSuccess(stream){
          window.stream = stream;
          video.srcObject = stream;
      }

      // load init
      init();
      // Draw image
      var context = canvas.getContext('2d');
      snap.addEventListener("click",function(){
          context.drawImage(video, 0, 0, 200, 100);
          console.log(photo.value);
      });

      const photo = document.getElementById('image');

      function merge(x, y, img)
      {
          var new_img = new Image();
          new_img.onload = function () {
            context.drawImage(new_img, x, y, 100, 200);
          }
          new_img.src = img;
      }

      function save() {
        photo.value = canvas.toDataURL();
      }

    </script>

</body>