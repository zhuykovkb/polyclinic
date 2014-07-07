<form action="" enctype="multipart/form-data" method="post">
    <p>*Name: <br/>
        <input type="text" name="name" value="<?php echo $patientData['name'] ?>"/>
    </p>

    <p>*Sex: <br/>
        <span>Male: <input type="radio" name="sex" value="male" <?php if ($patientData['sex'] == 'male') echo 'checked' ?> />  </span>
        <span>Female: <input type="radio" name="sex" value="female" <?php if ($patientData['sex'] == 'female') echo 'checked' ?> />  </span>
    </p>

    <img src="<?php echo "{$config['imagedir']}/{$patientData['photo']}" ?>"/>

    <p>Upload the photo</br>
        <input type="file" name="photo"/>
    </p>

    <p>*Patient`s card number (up to 6 characters, must be unique):<br/>
        <input type="text" name="card_num" value="<?php echo $patientData['card_num'] ?>"/>
    </p>

    <p>*City id (up to 4 characters):<br/>
        <input type="text" name="native_city_id" value="<?php echo $patientData['native_city_id'] ?>"/>
    </p>

    <p>Insurance number (must be unique):<br/>
        <input type="text" name="insurance_num" value="<?php echo $patientData['insurance_num'] ?>"/>
    </p>

    <p>E-mail (must be unique):<br/>
        <input type="text" name="email" value="<?php echo $patientData['email'] ?>"/>
    </p>

    <p><input type="submit" value="Save"></p>
</form>