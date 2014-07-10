<?php
function isOldData($patientData)
{
    $massiv = array();
        foreach ($_POST as $key => $value) {
            $massiv[] = ($patientData["$key"] == $_POST["$key"]) ? true : false;
            //echo "DATA: " . $patientData["$key"] . " POST: " . $_POST["$key"] . "<br>";
}
          //echo "result-><br>";
          var_dump($massiv);
return array_product($massiv);
}
