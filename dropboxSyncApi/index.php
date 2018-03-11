<?php
class DropboxV2Client
{

  /*
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;

public class DBClientService {

    private static final String token = "Bearer XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXx";

    public void listFolder(String foldername) throws Exception {

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

    }

    public void delete(String path) throws Exception {

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

        }

    public void createFolder(String path) throws Exception {

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

        }

    public void putFile(String foldername, String path) throws Exception {

          try {

            URL url = new URL("https://content.dropboxapi.com/2/files/upload");
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            String parameters = "{\"path\": \"" + foldername + "\"}";

            conn.setRequestProperty("Content-Type", "application/octet-stream");
            conn.addRequestProperty ("Authorization", token);
            conn.addRequestProperty ("Dropbox-API-Arg", parameters);
            conn.setRequestMethod("POST");


            conn.setDoOutput(true);

            Path pathFile = Paths.get(path);
            byte[] data = Files.readAllBytes(pathFile);

            DataOutputStream writer = new DataOutputStream(conn.getOutputStream());
            writer.writeBytes(parameters);
            writer.flush();

            writer.write(data);
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

        }

    public void getFile(String foldername) throws Exception {

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

        }


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
<?php
if (/*API KEY length + API KEY must be valid & must be a api that is connected with "peter's" Dropbox so noone else can steal and download the files to their  */) {
    // Allowing to press the buttons to sync to dropbox
  } else {
    // Button's continue to be locked
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>DropboxV2Client</title>
  </head>
  <body>

    <!--
    Loader with percentage for sync progress.
  -->

    <input type="password" name="password input" value="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX">

    <button class="button" type="button" id="sync" name="sync">Sync with dopbox</button>
    <button class="button" type="button" id="syncHome" name="syncHome">Sync Home</button>
    <button class="button" type="button" id="bothSync" name="bothSync">Both</button>
  </body>
</html>
