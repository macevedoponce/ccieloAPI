<?php

// Incluir el archivo de conexión
require 'conexion.php';

// Verificar si se ha recibido el parámetro id_rol
if(isset($_GET['id_rol'])) {
    // Obtener el parámetro id_rol
    $id_rol = $_GET['id_rol'];

    // Preparar la consulta SQL para obtener la lista de usuarios con el id_rol especificado
    $sql = "SELECT user_id, user_nombres, user_apellidos, user_dni, user_foto FROM Users WHERE id_rol = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_rol);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontraron usuarios con el id_rol especificado
    if ($result->num_rows > 0) {
        // Crear un array para almacenar los datos de los usuarios
        $users = array();

        // Recorrer los resultados y almacenar los datos de los usuarios en el array
        while($row = $result->fetch_assoc()) {
            $users[] = array(
                'id' => $row['user_id'],
                'nombres' => $row['user_nombres'],
                'apellidos' => $row['user_apellidos'],
                'dni' => $row['user_dni'],
                'foto' => $row['user_foto']
            );
        }

        // Devolver la lista de usuarios en formato JSON
        $response = array(
            'status' => 'success',
            'data' => $users
        );
    } else {
        // No se encontraron usuarios con el id_rol especificado
        $response = array(
            'status' => 'error',
            'message' => 'No se encontraron usuarios con el id_rol especificado'
        );
    }
} else {
    // No se ha recibido el parámetro id_rol, enviar un mensaje de error
    $response = array(
        'status' => 'error',
        'message' => 'El parámetro id_rol es obligatorio'
    );
}

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cerrar la conexión a la base de datos
$stmt->close();
$conexion->close();

?>