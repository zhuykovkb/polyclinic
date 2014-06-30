<?php
$patientToEditId = (int)$_GET['patientId'];
$patientPrepare = $patientsPdo->prepare("select * from patients where id = {$patientToEditId}");
$patientPrepare->execute();
$patientData = $patientPrepare->fetch(PDO::FETCH_ASSOC);
?>

<form action="" enctype="multipart/form-data" method="post">
    <p>*Name: <br/><input type="text" name="name" value="<?php echo $patientData['name'] ?>"/></p>

    <p>*Sex: <br/>
        <span>Male: <input type="radio" name="sex" value="male" <?php if ($patientData['sex'] == 'male') echo 'checked' ?> />  </span>
        <span>Female: <input type="radio" name="sex" value="female" <?php if ($patientData['sex'] == 'female') echo 'checked' ?>/>  </span>
    </p>
    <img src="<?php echo "{$config['imagedir']}/{$patientData['photo']}" ?>"/>
    <p>Upload the photo</br>
        <input type="file" name="photo"/></p>

    <p>*Patient`s card number (up to 6 characters, must be unique):<br/>
        <input type="text" name="card_num" value="<?php echo $patientData['card_num'] ?>"/></p>

    <p>*City id (up to 4 characters):<br/>
        <input type="text" name="native_city_id" value="<?php echo $patientData['native_city_id'] ?>"/></p>

    <p>Insurance number (must be unique):<br/>
        <input type="text" name="insurance_num" value="<?php echo $patientData['insurance_num'] ?>"/>
    </p>

    <p>E-mail (must be unique):<br/><input type="text" name="email" value="<?php echo $patientData['email'] ?>"/></p>

    <p><input type="submit" value="Save"></p>
</form>

<?php
if (!empty($_POST['card_num'])
    && !empty($_POST['name'])
    && !empty($_POST['sex'])
    && !empty($_POST['native_city_id'])
) {
    //add uni check for card_num, insurance_num, email
    $photo = $patientData['photo'];

    if (!empty($_FILES['photo']['name'])) {
        $upLoadFile = $config['upLoadDir'] . '/' . basename($_FILES['photo']['name']);
        //TODO
        //$imagesrc = '.' . $imagedir . '/' . $_FILES['photo']['name'];
        //TODO
        $uploaded = move_uploaded_file($_FILES['photo']['tmp_name'], $upLoadFile);
        if (!$uploaded) {
            var_dump($_FILES['error']);
        } else {
            $photo = $_FILES['photo']['name'];
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
        ":photo" => $photo,
    ];

    $insertQuery = "update patients set card_num=:card_num, name=:name, sex=:sex, native_city_id=:native_city_id,
                    insurance_num=:insurance_num, email=:email, photo=:photo where id=:id";
    $newPatientPrepared = $patientsPdo->prepare($insertQuery);
    $newPatientPrepared->execute($newPatient);

    echo "Done! New patient has been added.";
    echo '<a href="/?action=show&patientId=' . $patientToEditId . '">Show patient`s record</a>';
} else {
    if (!empty($_POST)) {
        echo "Empty input detected.<br/>Fill it.";
    }
}