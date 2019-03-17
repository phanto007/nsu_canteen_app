<!DOCTYPE html>

<html>

<head>

    <title>JQuery HTML5 QR Code Scanner using Instascan JS Example - ItSolutionStuff.com</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

</head>

<body>

  

    <h1>JQuery HTML5 QR Code Scanner using Instascan JS Example - ItSolutionStuff.com</h1>

    

    <video id="preview"></video>

    <script type="text/javascript">

      let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror:false });

      scanner.addListener('scan', function (content) {

        setTimeout(function() {
          window.location.href = "verify-order.php?e_str="+content+"&o_id=<?php echo $_POST['id']; ?>";
        }, 1000);

      });

      Instascan.Camera.getCameras().then(function (cameras) {

        if (cameras.length == 1) {

          scanner.start(cameras[0]);

        } 
        else if (cameras.length > 1) {
            scanner.start(cameras[1]);
        }
        else {

          console.error('No cameras found.');

        }

      }).catch(function (e) {

        console.error(e);

      });

    </script>

   

</body>

</html>
