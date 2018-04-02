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
      $url = "https://content.dropboxapi.com/2/files/create_folder";
      $header = array(
         "Authorization: ".$this->$token,
         "Content-Length: ".filesize($path),
         "Content-Type: application/json",
         "Dropbox-API-Arg: {\"path\": \"$path\"}"
         );
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $curl_response_res = curl_exec ($ch);
      $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
      curl_close($ch);
      return (200 === intval($http_code));
   }
   public function delete($path)
   {
      $url = "https://content.dropboxapi.com/2/files/delete_v2";
      $header = array(
         "Authorization: ".$this->$token,
         "Content-Type: application/json",
         "Dropbox-API-Arg: {\"path\": \"$path\"}"
         );
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $curl_response_res = curl_exec ($ch);
      $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
      curl_close($ch);
      return (200 === intval($http_code));
   }
   // Get the content of the file at $path.
   public function getFile($path)
   {
      $url = "https://content.dropboxapi.com/2/files/download";
      $header = array(
         "Authorization: ".$this->$token,
         "Content-Type: application/json",
         "Dropbox-API-Arg: {\"path\": \"$path\"}"
         );
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $curl_response = curl_exec ($ch);
      curl_close($ch);
      return $curl_response;
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
