<?php
require_once 'models.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    switch ($action) {
        case 'insert':
            $response = insertApplicant($_POST);
            break;
        case 'update':
            $response = updateApplicant($_POST['id'], $_POST);
            break;
        case 'delete':
            $response = deleteApplicant($_POST['id']);
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
