<?php 
require_once('../bd/conn.php');
if(!isset($_GET['id'])){
    echo "<script> alert('Id. de programa no definido.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

$delete = $conn->query("DELETE FROM `eventos` where id = '{$_GET['id']}'");
if($delete){
    echo "<script> alert('El evento se ha eliminado con éxito.');</script>";
    header("Location: ../views/calendario.php");
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$conn->close();

?>