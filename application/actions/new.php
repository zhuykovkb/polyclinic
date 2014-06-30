<form action="" enctype="multipart/form-data" method="post">
    <p>*Name: <br/><input type="text" name="name" placeholder="Name"/></p>

    <p>*Sex: <br/>
        <span>Male: <input type="radio" name="sex" value="male"/>  </span>
        <span>Female: <input type="radio" name="sex" value="female"/>  </span>
    </p>

    <p>Upload the photo</br><input type="file" name="photo"/></p>

    <p>*Patient`s card number (up to 6 characters, must be unique):<br/><input type="text" name="card_num"
                                                                               placeholder="Patient Card Number"/></p>

    <p>*City id (up to 4 characters):<br/><input type="text" name="native_city_id" placeholder="City (id for now)"/></p>

    <p>Insurance number (must be unique):<br/><input type="text" name="insurance_num" placeholder="Insurance Number"/>
    </p>

    <p>E-mail (must be unique):<br/><input type="text" name="email" placeholder="E-mail"/></p>

    <p><input type="submit" value="Save"></p>
</form>

<?php
if (!empty($_POST['card_num'])
    && !empty($_POST['name'])
    && !empty($_POST['sex'])
    && !empty($_POST['native_city_id'])
) {
    //add uni check for card_num, insurance_num, email
    $uploaded = false;
    if (!empty($_FILES['photo']['name'])) {
        $upLoadFile = $config['upLoadDir'] . '/' . basename($_FILES['photo']['name']);
        //TODO
        //$imagesrc = '.' . $imagedir . '/' . $_FILES['photo']['name'];
        //TODO
        $uploaded = move_uploaded_file($_FILES['photo']['tmp_name'], $upLoadFile);
        if (!$uploaded) {
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
        ":photo" => $uploaded ? $_FILES['photo']['name'] : null,
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
    if (!empty($_POST)) {
        echo "Empty input detected.<br/>Fill it.";
    }
}