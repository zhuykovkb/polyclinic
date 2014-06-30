<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Polyclinic</title>
</head>
<body>
<?php

require_once 'application/bootstrap.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

require_once('application/actions/main.php');

switch ($action) {
    case 'list':
        require_once('application/actions/list.php');
        break;
    case 'show':
        require_once('application/actions/show.php');
        break;
    case 'new':
        require_once('application/actions/new.php');
        break;
    case 'edit':
        break;
    case 'delete':
        break;
    default:
        break;
}

?>
</body>
</html>