<?php
if (/*API KEY length + API KEY must be valid & must be a api that is connected with "peter's" Dropbox so no one else can steal and download the files to their  */) {
    // Allowing to press the buttons to sync to dropbox
    // Add header("Location: //swedcraft.net/admin"); so you don't get the send again form alert
  } else {
    // Button's continue to be locked
  }
 ?>
<?php
  // Percentage that determinds how much is left of sync.
 ?>

 <!-- Right now there is javascript That does this. Will see later. -->
<!DOCTYPE html>
<html>
 <head>
   <meta charset="utf-8">
   <title>DropboxV2Client</title>

       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

       <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
       <!--script src="JavaScript.js"></script--> 
      <style media="screen">
       /* Change Color of bar etc
       #myBar {
           width: 0%;
           height: 30px;
           background-color: #4CAF50;
           color: white;
       }
       */
       </style>

         <script type="text/javascript">
         // Music & Progress Bar script
             function move() {
                 var elem = document.getElementById("progressBar");
                 var width = 0;
                 var time = setInterval(frame, 100);
                 function frame() {
                     if (width >= 100) {
                         clearInterval(time);
                         var audio1 = document.getElementById("sync");
                         var audio2 = document.getElementById("syncHome");
                         var audio3 = document.getElementById("bothSync");
                         audio1.pause();
                         audio2.pause();
                         audio3.pause();
                         audio2.currentTime = 0;
                         audio1.currentTime = 0;
                         audio3.currentTime = 0;
                         $('#done').html("<a href=\"./\"><h3>Sync Done Press Here To Sync Again</h3> </a>");
                     } else {
                         width++;
                         elem.style.width = width + '%';
                         elem.innerHTML = width * 1 + '%';
                     }
                 }
             }
             function play(id)
             {
               // alert("id="+id); To show which button is pressed
               var audio1 = document.getElementById("sync");
               var audio2 = document.getElementById("syncHome");
               var audio3 = document.getElementById("bothSync");
               move();
               if (id == "sync")
               {
                 audio2.pause();
                 audio3.pause();
                 audio1.play();
                 audio2.currentTime = 0;
                 audio3.currentTime = 0;
               }
               else if (id == "syncHome")
               {
                 audio1.pause();
                 audio3.pause();
                 audio2.play();
                 audio3.currentTime = 0;
                 audio1.currentTime = 0;
               }
               else if (id == "bothSync")
               {
                 audio1.pause();
                 audio2.pause();
                 audio3.play();
                 audio2.currentTime = 0;
                 audio1.currentTime = 0;
               }
               else
               {
                 audio1.pause();
                 audio2.pause();
                 audio3.pause();
                 audio2.currentTime = 0;
                 audio1.currentTime = 0;
                 audio3.currentTime = 0;
               }
             }
           // Buttons disabled script
          function TestInput()
          {
            if( $('#ApiKeyCheckBox').is(':checked')
              && (64 == $('#ApiKey').val().length) ) {
                $('.syncButton').prop('disabled', false).removeClass('btn-secondary').addClass('btn-primary');
            }
            else {
                $('.syncButton').prop('disabled', true).removeClass('btn-primary').addClass('btn-secondary');

            }
          }
          $(document).ready(function(){
             $('.syncButton').prop('disabled', true);
             $('#ApiKey').keyup(TestInput);
             $('#ApiKeyCheckBox').change(TestInput);
             $('.syncButton').click(function() {
               $('.syncButton').prop('disabled', true).removeClass('btn-primary').addClass('btn-secondary');
               $('#ApiKey').prop('disabled', true);
               $('#ApiKeyCheckBox').prop('disabled', true);
             });
          });


          </script>


   </head>
   <body>

         <!--
         Loader with percentage for sync progress.
       -->
       <center>
        <div id="done" class="">
           <audio id="sync" src="EM.mp3" loop > </audio>
           <audio id="syncHome" src="EM.mp3" loop > </audio>
           <audio id="bothSync" src="EM.mp3" loop > </audio>

   <br>
           <form class="" action="./" method="POST">
             <!-- ^^ Use later to trigger PHP script ^^ -->
             <input type="password" id="ApiKey" name="ApiKey" placeholder="Enter ApiKey" required autocomplete="off" value="1234567890123456789012345678901234567890123456789012345678901234">
             <input type="checkbox" id="ApiKeyCheckBox" name="ApiKeyCheckBox" required>
   <br>
             <button  class="syncButton btn btn-secondary" disabled type="button" id="sync" name="sync" onclick="play('sync')" >Sync To Dopbox</button>
             <button  class="syncButton btn btn-secondary" disabled type="button" id="syncHome" name="syncHome" onclick="play('syncHome')" >Sync To WebServer</button>
             <button  class="syncButton btn btn-secondary" disabled type="button" id="bothSync" name="bothSync" onclick="play('bothSync')" >Both</button>


             </div>
           </form>
        </center>
   <br>
        <div class="progress">
         <div
         class="progress-bar progress-bar-striped progress-bar-animated"
         role="progressbar"
         aria-valuenow="0"
         aria-valuemin="0"
         aria-valuemax="100"
         style="width:0%"
         id="progressBar" >
           0%
         </div>
       </div>

 </body>
</html>
