<?php

require 'conexion.php';

if(isset($_GET['dni'], $_GET['password'])) {
    $dni = $_GET['dni'];
    $password = $_GET['password'];

    $sql = "SELECT user_id, user_nombres, user_apellidos, user_dni, user_password, user_foto FROM Users WHERE user_dni = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['user_password'];

        if (password_verify($password, $storedPassword)) {
            $response = array(
                'status' => 'success',
                'data' => array(
                    'id' => $row['user_id'],
                    'nombres' => $row['user_nombres'],
                    'apellidos' => $row['user_apellidos'],
                    'dni' => $row['user_dni'],
                    'foto' => $row['user_foto']
                )
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Usuario o Contraseña incorrecta'
            );
        }
    } else {
        
        $response = array(
            'status' => 'error',
            'message' => 'Usuario no encontrado'
        );
    }
} else {
    
    $response = array(
        'status' => 'error',
        'message' => 'Todos los parámetros son obligatorios'
    );
}

header('Content-Type: application/json');
echo json_encode($response);

$stmt->close();
$conexion->close();

?>
