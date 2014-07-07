<?php

function fileUpload($uploadDir) {
    if (!empty($_FILES['photo']['name'])) {
        $type = strtolower(substr(strrchr($_FILES['photo']['name'],'.'), 1));
        $fname = preg_replace('/[^0-9]/', '', $_POST['card_num']);
        $img = $fname . '.' . $type;
        $upLoadFile = $uploadDir . '/' . $img;
        $uploaded = move_uploaded_file($_FILES['photo']['tmp_name'], $upLoadFile);
        if ($uploaded) {
            return $img;
        }
    }
}