<?php


$patientToEditId = (!empty($_GET['patientId'])) ? (int)$_GET['patientId'] : null;
$patientPrepare = $patientsPdo->prepare("select * from patients where id = :id");
$patientPrepare->bindParam(':id', $patientToEditId);
$patientPrepare->execute();
$patientData = $patientPrepare->fetch(PDO::FETCH_ASSOC);

if ($patientData) {
	
    require_once ('application/views/editPatient.php');
    require_once ('application/actions/fileUpload.php');
    require_once ('application/actions/checkMime.php');
    require_once ('application/actions/isOldData.php');
    
    $validMime = isset($_FILES['photo']) ? checkMime($_FILES['photo']['type']) : 1;
    echo "Mime --> " . $validMime . "<br />";
    if (!isOldData($patientData) && $validMime) {
        $photo = $patientData['photo'];
        $checkPatient = array(
            ":id" => $patientToEditId,
            ":card_num" => $_POST['card_num'],
            ":insurance_num" => !empty($_POST['insurance_num']) ? $_POST['insurance_num'] : null,
            ":email" => !empty($_POST['email']) ? $_POST['email'] : null
        );
        $checkQuery = "select card_num, insurance_num, email from patients
                            where (card_num=:card_num OR insurance_num=:insurance_num OR email=:email) AND id != :id";
        $checkUnique = $patientsPdo->prepare($checkQuery);
        $checkUnique->execute($checkPatient);
        if (!$result = $checkUnique->fetchAll())
          {
            $img = fileUpload($config['upLoadDir']);
            if (!$img)
              {
                if (isset($_FILES['error']))
                  {
                    var_dump($_FILES['error']);
                  }
              }
            $newPatient = array(
                ":id" => $patientToEditId,
                ":card_num" => $_POST['card_num'],
                ":name" => $_POST['name'],
                ":sex" => $_POST['sex'],
                ":native_city_id" => $_POST['native_city_id'],
                ":insurance_num" => !empty($_POST['insurance_num']) ? $_POST['insurance_num'] : null,
                ":email" => !empty($_POST['email']) ? $_POST['email'] : null,
                ":photo" => $img ? $img : $photo
            );
            $insertQuery = "update patients
                                  set card_num     = :card_num,
                                    name           = :name,
                                    sex            = :sex,
                                    native_city_id = :native_city_id,
                                    insurance_num  = :insurance_num,
                                    email          = :email,
                                    photo          = :photo
                                  where id = :id";
            $newPatientPrepared = $patientsPdo->prepare($insertQuery);
            $newPatientPrepared->execute($newPatient);
            $link = '?action=show&patientId=' . $patientToEditId;
            header("Location: $link");
          }
        else
          {
            echo errorUserAlreadyExists();
          }
      }
    elseif (isset($_FILES['photo']) && $validMime){
        $img = fileUpload($config['upLoadDir']);
            if (!$img)
              {
                if (isset($_FILES['error']))
                  {
                    var_dump($_FILES['error']);
                  }
	      }
                $newPhoto = array(
                    ":id" => $patientToEditId,
                    ":photo" => $img ? $img : $photo
                );
                $insertQuery = "update patients
                                    set photo = :photo
                                    where id = :id";
                $newPatientPrepared = $patientsPdo->prepare($insertQuery);
                $newPatientPrepared->execute($newPhoto);
                $link = '?action=show&patientId=' . $patientToEditId;
                header("Location: $link");
	}else{
        if (!empty($_POST))
          {
            echo errorEmptyInputDetected();
          }
      }
  }
else
  {
    echo errorUserNotFound();
  }
