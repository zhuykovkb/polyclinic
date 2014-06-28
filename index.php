<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Polyclinic</title>
  </head>
  <body>
    <?php
      $patientsPdo = new PDO(
          'mysql:host=localhost; dbname=polyclinic', 'root', '123321'
      );

      $patientsPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $patientsPrepared = $patientsPdo
        ->prepare(
          'select * from patients'
        );  
      //object(PDOStatement)#2 (1) { ["queryString"]=> string(22) "select * from patients" } 
      
      $patientsPrepared->execute(); 
      //object(PDOStatement)#2 (1) { ["queryString"]=> string(22) "select * from patients" }
      
      $list = $patientsPrepared->fetchAll();

      //Add a condition to show the list of patients
      require 'list.php';
      
      
      if ($_SERVER['REQUEST_METHOD'=='GET']){
        if (isset($_GET['patient_id'])) {
          require 'show.php';
        }
      }
    ?>
  </body>
 </html>