<?php

require '../conexion.php';

// Verificar si se han enviado los datos del usuario a eliminar
if(isset($_POST['user_dni'], $_POST['user_password'])) {
    $dni = $_POST['user_dni'];
    $password = $_POST['user_password'];

    // Consulta para obtener el usuario con el DNI proporcionado
    $sql = "SELECT * FROM Users WHERE user_dni = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró un usuario con el DNI proporcionado
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verificar si la contraseña proporcionada coincide con la almacenada (considerando que está encriptada)
        if (password_verify($password, $user['user_password'])) {
            // Eliminar el usuario de la base de datos
            $delete_sql = "DELETE FROM Users WHERE user_dni = ?";
            $delete_stmt = $conexion->prepare($delete_sql);
            $delete_stmt->bind_param("s", $dni);

            if ($delete_stmt->execute()) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Usuario eliminado exitosamente'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Error al eliminar usuario: ' . $delete_stmt->error
                );
            }
            $delete_stmt->close();
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'El usuario o contraseña proporcionados no son correctos'
            );
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Usuario no encontrado'
        );
    }
    $stmt->close();
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Los campos son requeridos'
    );
}

header('Content-Type: application/json');
echo json_encode($response);

$conexion->close();

?>
