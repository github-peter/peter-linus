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
             
           // Button disable script
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

