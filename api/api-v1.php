<?php

//Contenido tipo JSON
header("Constent-type: application/json");

//Conexión de la base de datos
$conn = new mysqli("localhost", "root", "", "cmm");

if ($conn->connect_error) {
    die("Error en la conexión con la base de datos");
}
$res = array('error' => false);

//Leer datos de la base de datos
$action = 'read';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

switch ($action) {
    case 'read':
        $result = $conn->query("SELECT * FROM `comments`");
        $cards = array();

        while ($row = $result->fetch_assoc()) {
            array_push($cards, $row);
        }

        $res['cards'] = $cards;
        break;
    case 'create':
        $title = $_POST['title'];
        $header = $_POST['header'];
        $body = $_POST['body'];
        $date = date("Y-m-d H:i");
        $result = $conn->query("INSERT INTO `comments` (`user_id`, `categoria_id`, `title`, `header`, `body`, `dateCreate`, `dateEdit`) VALUES
        (1,1, '$title', '$header', '$body', null , null )");
        if ($result) {
            $res['message'] = 'Tarjeta creada correctamente';
        } else {
            $res['message'] = 'Lo sentimos no se a podido craer la tarjeta';
            $res['error'] = true;
        }

        break;
    case 'edit':
        $id = $_POST['id'];
        $title = $_POST['title'];
        $header = $_POST['header'];
        $body = $_POST['body'];
        $dateEdit = date("Y-m-d H:i");
        $sql = "UPDATE `comments` SET `title` = '$title',`header` = '$header',`body` = '$body',`dateEdit` = '$dateEdit' WHERE `id`='$id'";
        $result = $conn->query($sql);
        if ($result) {
            $res['message'] = 'Tarjeta actualizada con éxito';
        } else {
            $res['message'] = 'No se a podido actualizar la tarjeta, lo sentimos';
            $res['error'] = true;
        }
        break;
    case 'delete':
        $id = $_POST['id'];
        $result = $conn->query("DELETE FROM `comments` WHERE `id` = '$id'");
        if ($result) {
            $res['message'] = 'Tarjeta eliminada con éxito';
        } else {
            $res['message'] = 'No se ha podido eliminar la tarjeta, lo sentimos';
            $res['error'] = true;
        }
        break;
}

$conn->close();

echo json_encode($res);
die();
