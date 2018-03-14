<?php
class DropboxV2Client
{
   private $token;
   public function __construct($OAUTH2_ACCESS_TOKEN)
   {
     $this->$token = "Bearer " . $OAUTH2_ACCESS_TOKEN;
   }
   public function createFolder($path)
   {
    /*
    try {

      URL url = new URL("https://api.dropboxapi.com/2/files/create_folder");
      HttpURLConnection conn = (HttpURLConnection) url.openConnection();
      String parameters = "{\"path\": \"" + path + "\"}";

      conn.setRequestProperty("Content-Type", "application/json");
      conn.addRequestProperty ("Authorization", token);
      conn.setRequestMethod("POST");


      conn.setDoOutput(true);

      DataOutputStream writer = new DataOutputStream(conn.getOutputStream());
      writer.writeBytes(parameters);
      writer.flush();

      if (writer != null)
          writer.close();

      if (conn.getResponseCode() != 200) {
          System.out.println(conn.getResponseMessage());
          throw new RuntimeException("Failed : HTTP error code : "
                  + conn.getResponseCode());
      }

      BufferedReader br = new BufferedReader(new InputStreamReader(
          (conn.getInputStream())));

      String output;
      System.out.println("Output from Server .... \n");
      while ((output = br.readLine()) != null) {
          System.out.println(output);
      }

      conn.disconnect();

    } catch (MalformedURLException e) {

      e.printStackTrace();

    } catch (IOException e) {

      e.printStackTrace();

    }

     */
   }
   public function delete($path)
   {
     /*
     try {

       URL url = new URL("https://api.dropboxapi.com/2/files/delete_v2");
       HttpURLConnection conn = (HttpURLConnection) url.openConnection();
       String parameters = "{\"path\": \"" + path + "\"}";

       conn.setRequestProperty("Accept", "application/json");
       conn.addRequestProperty ("Authorization", token);
       conn.setRequestMethod("POST");
       conn.setRequestProperty("Content-Type", "application/json");

       conn.setDoOutput(true);

       DataOutputStream writer = new DataOutputStream(conn.getOutputStream());
       writer.writeBytes(parameters);
       writer.flush();

       if (writer != null)
           writer.close();

       if (conn.getResponseCode() != 200) {
           System.out.println(conn.getResponseMessage());
           throw new RuntimeException("Failed : HTTP error code : "
                   + conn.getResponseCode());
       }

       BufferedReader br = new BufferedReader(new InputStreamReader(
           (conn.getInputStream())));

       String output;
       System.out.println("Output from Server .... \n");
       while ((output = br.readLine()) != null) {
           System.out.println(output);
       }

       conn.disconnect();

     } catch (MalformedURLException e) {

       e.printStackTrace();

     } catch (IOException e) {

       e.printStackTrace();

     }
      */
   }
   public function getFile($foldername)
   {
     /*
     try {

       URL url = new URL("https://content.dropboxapi.com/2/files/download");
       HttpURLConnection conn = (HttpURLConnection) url.openConnection();
       String parameters = "{\"path\": \"" + foldername + "\"}";

       conn.addRequestProperty ("Authorization", token);
       conn.addRequestProperty ("Dropbox-API-Arg", parameters);
       conn.setDoOutput(true);

       if (conn.getResponseCode() != 200) {
           System.out.println(conn.getResponseMessage());
           throw new RuntimeException("Failed : HTTP error code : "
                   + conn.getResponseCode());
       }

       BufferedReader br = new BufferedReader(new InputStreamReader(
           (conn.getInputStream())));

       String output;
       System.out.println("Output from Server .... \n");
       while ((output = br.readLine()) != null) {
           System.out.println(output);
       }

       conn.disconnect();

     } catch (MalformedURLException e) {

       e.printStackTrace();

     } catch (IOException e) {

       e.printStackTrace();

     }
      */
   }
   public function listFolder($foldername)
   {
     /*

           try {

             URL url = new URL("https://api.dropboxapi.com/2/files/list_folder");
             HttpURLConnection conn = (HttpURLConnection) url.openConnection();
             String parameters = "{\"path\": \"" + foldername + "\",\"recursive\": false,\"include_media_info\": false,\"include_deleted\": false,\"include_has_explicit_shared_members\": false}";

             conn.setRequestProperty("Accept", "application/json");
             conn.addRequestProperty ("Authorization", token);
             conn.setRequestMethod("POST");
             conn.setRequestProperty("Content-Type", "application/json");

             conn.setDoOutput(true);

             DataOutputStream writer = new DataOutputStream(conn.getOutputStream());
             writer.writeBytes(parameters);
             writer.flush();

             if (writer != null)
                 writer.close();

             if (conn.getResponseCode() != 200) {
                 System.out.println(conn.getResponseMessage());
                 throw new RuntimeException("Failed : HTTP error code : "
                         + conn.getResponseCode());
             }

             BufferedReader br = new BufferedReader(new InputStreamReader(
                 (conn.getInputStream())));

             String output;
             System.out.println("Output from Server .... \n");
             while ((output = br.readLine()) != null) {
                 System.out.println(output);
             }

             conn.disconnect();

           } catch (MalformedURLException e) {

             e.printStackTrace();

           } catch (IOException e) {

             e.printStackTrace();

           }

      */
   }
   // Return TRUE if the file was uploaded properly.
   public function putFile($dropboxpath,$local_path)
   {
      $url = "https://content.dropboxapi.com/2/files/upload";
      $header = array(
         "Authorization: ".$this->$token,
         "Content-Length: ".filesize($local_path),
         "Content-Type: application/octet-stream",
         "Dropbox-API-Arg: {\"path\": \"$dropboxpath\",\"mute\": false}"
         );

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

      $fh_res = fopen($local_path, 'rb');
      $file_data = fread($fh_res, filesize($local_path));
      rewind($fh_res);

      curl_setopt($ch, CURLOPT_INFILE, $fh_res);
      curl_setopt($ch, CURLOPT_INFILESIZE, filesize($local_path));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

      $curl_response_res = curl_exec ($ch);

      //echo $curl_response_res; // Server response
      //print_r(curl_getinfo($ch)); // Http Response
      $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);

      curl_close($ch);
      fclose($fh_res);

      return (200 === intval($http_code));
   }
  /*
    public static void main(String[] args) throws Exception {
        DBClientService dbcs = new DBClientService();
        String folderName = "/test_createFolder" + System.currentTimeMillis();
        String newFolderName = folderName + "/NewFolder";
        dbcs.createFolder(folderName);
        dbcs.listFolder("");
        dbcs.delete(folderName);
        dbcs.putFile("/test_createFolder/skills.txt", "C:/Users/IBM_ADMIN/Desktop/skills.txt");
        dbcs.getFile("/test_createFolder/skills.txt");
    }
  */

  // ^Dropbox ReST API v2 to create folder, list folder, get, put and delete file using Java^

  function traverse_files($root)
  {
    foreach(new DirectoryIterator($root) as $fileInfo)
    {
        if($fileInfo->isDir() && (!$fileInfo->isDot()))
        {
          // Compare with dropbox eqvuvelent
        }
    }
  }
}
?>

<!-- ======= -->

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
         class="progress-bar progress-bar-striped active"
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
