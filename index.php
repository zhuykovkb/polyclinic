<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Polyclinic</title>
  </head>
  <body>
    <?php
      require 'mysqlConnect.php';
      /*$patientsPdo = new PDO(
          'mysql:host=localhost; dbname=polyclinic', 'root', '123321'
      );
      */

      /*$patientsPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/

      
      //List all the patients
      if ($_GET['action']=='list') {
        require 'list.php';    
      } 
      //Show the full patient's data
      //TODO:Add a check if the patient still exists
      if (($_GET['action']=='show')
        &&  (isset($_GET['patientId']))){
        require 'show.php';
      }
      //Add a new patient record
      if ($_GET['action']=='new') {
       require 'new.php';
      }
    ?>
  </body>
 </html>