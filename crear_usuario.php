<?php

require 'conexion.php';

if(isset($_POST['nombres'], $_POST['apellidos'], $_POST['dni'], $_POST['password'], $_POST['id_rol'])) {

    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $password = $_POST['password'];
    $id_rol = $_POST['id_rol'];

    $sql = "SELECT COUNT(*) AS count FROM Users WHERE user_dni = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $existingUsers = intval($row['count']);
    $stmt->close();

    if ($existingUsers > 0) {
        $response = array(
            'status' => 'error',
            'message' => 'Ya existe un usuario con este DNI.'
        );
    } else {

        $opciones = [
            'cost' => 12,
        ];
        $passHash =  password_hash($password, PASSWORD_BCRYPT, $opciones);

        $sql = "INSERT INTO Users (user_nombres, user_apellidos, user_dni, user_password, id_rol) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssssi", $nombres, $apellidos, $dni, $passHash, $id_rol);

        if ($stmt->execute()) {
            $response = array(
                'status' => 'success',
                'message' => 'Usuario registrado exitosamente'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Error al registrar usuario: ' . $stmt->error
            );
        }
        $stmt->close();
    }
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
