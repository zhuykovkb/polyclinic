<?php

require_once ('application/views/newPatient.php');
require_once ('application/actions/fileUpload.php');
require_once ('application/actions/checkMime.php');
/*
 * @TODO for Kirill PHP Notice:  Undefined index: photo in /var/www/epic.local/www/data/application/actions/new.php on line 9
 */
$isValidMimeType = checkMime($_FILES['photo']['type']);

if (!empty($_POST['name'])
    && !empty($_POST['card_num'])
    && !empty($_POST['sex'])
    && !empty($_POST['native_city_id'])
    && $isValidMimeType
) {
    $checkPatient = array(
        ":card_num"      => $_POST['card_num'],
        ":insurance_num" => !empty($_POST['insurance_num']) ? $_POST['insurance_num'] : null,
        ":email"         => !empty($_POST['email']) ? $_POST['email'] : null,
    );

    $checkQuery = "select card_num, insurance_num, email from patients
                    where card_num=:card_num or insurance_num=:insurance_num or email=:email";
    $checkUnique = $patientsPdo -> prepare($checkQuery);
    $checkUnique -> execute($checkPatient);

    if (!$result = $checkUnique -> fetchAll()) {

        $img=fileUpload($config['upLoadDir']);

        if (!$img) {
            if (isset($_FILES['error'])) {
                 var_dump($_FILES['error']);
            }
        }

        $newPatient = array(
            ":card_num"       => $_POST['card_num'],
            ":name"           => $_POST['name'],
            ":sex"            => $_POST['sex'],
            ":native_city_id" => $_POST['native_city_id'],
            ":insurance_num"  => !empty($_POST['insurance_num']) ? $_POST['insurance_num'] : null,
            ":email"          => !empty($_POST['email']) ? $_POST['email'] : null,
            ":photo"          => $img ? $img : null,
        );

        $insertQuery = "insert into patients (card_num, name, sex, native_city_id, insurance_num, email, photo)
                                     values (:card_num, :name, :sex, :native_city_id, :insurance_num, :email, :photo)";
        $newPatientPrepared = $patientsPdo -> prepare($insertQuery);
        $newPatientPrepared -> execute($newPatient);

        echo '<p>Done! New patient has been added.</p>';


        $newPatientId = $patientsPdo -> lastInsertId();
        echo '<a href="/?action=show&patientId=' . $newPatientId . '">Show patient`s record</a>';
    } else {
        echo '<p>Sorry, this user already exists</p>';
    }
} elseif (!empty($_POST)){
    if ($isValidMimeType) {
        echo '<p>Empty input detected.<br/>Fill it.</p>';
    } else {
        echo '<p>U can upload only images</p>';
    }
}