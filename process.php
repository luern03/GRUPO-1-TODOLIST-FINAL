<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '1234', 'crud') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$location = '';
$anio = '';

if (isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];
    $anio = $_POST['anio'];

    $mysqli->query("INSERT INTO data (name, location, anio) VALUES('$name', '$location','$anio')") or die($mysqli->error);

    $_SESSION['message'] = "El registro se ha guardado!";
    $_SESSION['msg_type'] = "success";

    header('location: indexT.php');
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "El registro ha sido eliminado!";
    $_SESSION['msg_type'] = "danger";

    header('location: indexT.php');
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if ($result){
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
        $anio = $row['anio'];
    }
}
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $anio = $POST['anio'];

    $mysqli->query("UPDATE data SET name='$name', location='$location', anio='$anio' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Se actualizó el registro!";
    $_SESSION['msg_type'] = "warning";

    header('location: indexT.php');
}