<?php
$patientToEditId = (!empty($_GET['patientId'])) ? (int) $_GET['patientId'] : null;
$patientPrepare = $patientsPdo->prepare("select * from patients where id = :id");
$patientPrepare->bindParam(':id',$patientToEditId);
$patientPrepare->execute();
$patientData = $patientPrepare->fetch(PDO::FETCH_ASSOC);

require_once('application/templates/editForm.php');
require_once('application/actions/fileUpload.php');

if (!empty($_POST['card_num'])
    && !empty($_POST['name'])
    && !empty($_POST['sex'])
    && !empty($_POST['native_city_id'])
    && checkMime($_FILES['photo']['type'])
) {
    $photo = $patientData['photo'];

    $checkPatient = [
        ":id" => $patientToEditId,
        ":card_num" => $_POST['card_num'],
        ":insurance_num" => !empty($_POST['insurance_num']) ? $_POST['insurance_num'] : null,
        ":email" => !empty($_POST['email']) ? $_POST['email'] : null,
        ];

    $checkQuery = "select card_num, insurance_num, email from patients where (card_num=:card_num OR insurance_num=:insurance_num OR email=:email) AND id != :id";
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
            ":id" => $patientToEditId,
            ":card_num" => $_POST['card_num'],
            ":name" => $_POST['name'],
            ":sex" => $_POST['sex'],
            ":native_city_id" => $_POST['native_city_id'],
            ":insurance_num" => !empty($_POST['insurance_num']) ? $_POST['insurance_num'] : null,
            ":email" => !empty($_POST['email']) ? $_POST['email'] : null,
            ":photo" => $img ? $img : $photo,
        ];

        $updateQuery = "update patients set card_num=:card_num, name=:name, sex=:sex, native_city_id=:native_city_id,
                    insurance_num=:insurance_num, email=:email, photo=:photo where id=:id";
        $newPatientPrepared = $patientsPdo->prepare($updateQuery);
        $newPatientPrepared->execute($newPatient);

        $link="http://". $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        header("Location: $link");
    } else {
        echo "Sorry, this user already exists";
    }
} elseif (!empty($_POST)) {
    echo "Empty input detected.<br/>Fill it.";
} else {
    echo "User not found";
}

