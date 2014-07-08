<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Polyclinic</title>
</head>
<body>
<?php

require_once('application/bootstrap.php');
require_once('application/views/flashMessage.php');
require_once('application/views/menu.php');

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

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
        require_once('application/actions/edit.php');
        break;
    case 'delete':
        require_once('application/actions/delete.php');
        break;
    default:
        break;
}

/*
 * @TODO htmlescape, redirect (from new&edit to show, from delete to list)
 */
?>
</body>
</html>

