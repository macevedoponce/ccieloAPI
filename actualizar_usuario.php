<?php

require 'conexion.php';

if(isset($_POST['nombres'], $_POST['apellidos'], $_POST['dni'], $_POST['id_user'])) {

    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $id_user = $_POST['id_user'];
    $foto = "";
    if(isset($_POST['foto'])){
        $foto = $_POST['foto'];
    }

    $sql = "UPDATE Users SET user_nombres = ?, user_apellidos = ?, user_dni = ?, user_foto = ? WHERE user_id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssi", $nombres, $apellidos, $dni, $foto, $id_user);
    if ($stmt->execute()) {
        $response = array(
            'status' => 'success',
            'message' => 'Usuario actualizado exitosamente'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error al actualizar usuario: ' . $stmt->error
        );
    }
    $stmt->close();
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Todos los campos son obligatorios'
    );
}

header('Content-Type: application/json');
echo json_encode($response);

$conexion->close();

?>
