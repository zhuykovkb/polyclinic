<?php
function isOldData($patientData)
{
    $massiv = array();
        foreach ($_POST as $key => $value) {
            $massiv[] = ($patientData["$key"] == $_POST["$key"]) ? true : false;
}
return array_product($massiv);
}
