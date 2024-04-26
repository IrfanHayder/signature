<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/css/main.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
  
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo e(asset('/assets/js/jss.js')); ?>"></script>
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <title>Signature</title>
    <style>
      .kbw-signature { 
        width: 100%;
        height: 200px;
        display: block;
        overflow: hidden;
      }
      #sig canvas{
          height: auto;
          width: auto !important;
      }
      .game-box{
        width: 55%;
      }
      @font-face {
            font-family: 'arial !important';
      }
      @media only screen and (max-width: 767px){
         .game-box{
          width: 100% !important;
         }
      }
  </style>
</head>
<body style="background: #5E63BA;font-family:arial !important;">
    <div class="container">
      <?php echo $__env->yieldContent('main'); ?>
    </div>  




    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>

    <script type="text/javascript">
        var canvas = document.getElementById('sig');
        var signaturePad = new SignaturePad(canvas,{
          maxwidth: 1,
          minwidth: 1,
        });
    
        $('#clear').click(function(e) {
            e.preventDefault();
            signaturePad.clear();
            $("#signature64").val('');
        });
    
        // Handle form submission
        $('#signatureForm').submit(function(e) {
            // Generate Base64 image data and set it in the hidden input field
            var signatureImage = signaturePad.toDataURL();
            $("#signature64").val(signatureImage);
            // Continue with the form submission
            return true;
        });
  </script>
    
</body>
</html><?php /**PATH D:\All laravel\signature\resources\views/components/main.blade.php ENDPATH**/ ?>