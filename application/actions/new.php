<?php

require_once ('application/templates/newForm.php');
require_once ('application/actions/fileUpload.php');
$checkMimeType = checkMime($_FILES['photo']['type']);

if (!empty($_POST['card_num'])
    && !empty($_POST['name'])
    && !empty($_POST['sex'])
    && !empty($_POST['native_city_id'])
    && $checkMimeType
) {
    $checkPatient = [
        ":card_num" => $_POST['card_num'],
        ":insurance_num" => !empty($_POST['insurance_num']) ? $_POST['insurance_num'] : null,
        ":email" => !empty($_POST['email']) ? $_POST['email'] : null,
        ];

    $checkQuery = "select card_num, insurance_num, email from patients  where card_num=:card_num OR insurance_num=:insurance_num OR email=:email";
    $checkUniq = $patientsPdo->prepare($checkQuery);
    $checkUniq->execute($checkPatient);

    if (!$result = $checkUniq->fetchAll()) {
        $img=fileUpload($config['upLoadDir']);
        if (!$img) {
            if (isset($_FILES['error'])) {
                 var_dump($_FILES['error']);
            }
        }

        $newPatient = [
            ":card_num" => $_POST['card_num'],
            ":name" => $_POST['name'],
            ":sex" => $_POST['sex'],
            ":native_city_id" => $_POST['native_city_id'],
            ":insurance_num" => !empty($_POST['insurance_num']) ? $_POST['insurance_num'] : null,
            ":email" => !empty($_POST['email']) ? $_POST['email'] : null,
            ":photo" =>  $img ? $img : null,
        ];

        $insertQuery = "insert into patients (card_num, name, sex, native_city_id, insurance_num, email, photo)
                                     values (:card_num, :name, :sex, :native_city_id, :insurance_num, :email, :photo)";
        $newPatientPrepared = $patientsPdo->prepare($insertQuery);
        $newPatientPrepared->execute($newPatient);

        echo "Done! New patient has been added.";

        //In odd to show full patient`s data
        $newPatientId = $patientsPdo->lastInsertId();
        echo '<a href="/?action=show&patientId=' . $newPatientId . '">Show patient`s record</a>';
    } else {
        echo "Sorry, this user already exists";
    }
} elseif (!empty($_POST)){
    if ($checkmime) {
        echo "Empty input detected.<br/>Fill it.";
    } else {
        echo "U can upload only images";
    }
}