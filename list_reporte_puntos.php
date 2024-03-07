<?php

// Incluir el archivo de conexión
require 'conexion.php';

// Verificar si se ha recibido el parámetro id_user
if(isset($_GET['id_user'])) {
    // Obtener el parámetro id_user
    $id_user = $_GET['id_user'];

    // Preparar la consulta SQL para obtener los puntos del usuario
    $sql = "SELECT puntos_participacion, puntos_asistencia, puntos_biblia, puntos_fecha FROM Puntos WHERE id_user = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontraron puntos para el usuario
    if ($result->num_rows > 0) {
        // Crear un array para almacenar los datos de los puntos
        $puntos = array();
        $subtotal_participacion = 0;
        $subtotal_asistencia = 0;
        $subtotal_biblia = 0;

        // Recorrer los resultados y almacenar los datos de los puntos en el array
        while($row = $result->fetch_assoc()) {
            $puntos[] = array(
                'puntos_participacion' => $row['puntos_participacion'],
                'puntos_asistencia' => $row['puntos_asistencia'],
                'puntos_biblia' => $row['puntos_biblia'],
                'puntos_fecha' => $row['puntos_fecha']
            );
            // Calcular subtotales
            $subtotal_participacion += $row['puntos_participacion'];
            $subtotal_asistencia += $row['puntos_asistencia'];
            $subtotal_biblia += $row['puntos_biblia'];
        }

        // Calcular total completo de puntos
        $total_completo = $subtotal_participacion + $subtotal_asistencia + $subtotal_biblia;

        // Devolver los datos de los puntos, subtotales y total completo en formato JSON
        $response = array(
            'status' => 'success',
            'data' => $puntos,
            'subtotal_participacion' => $subtotal_participacion,
            'subtotal_asistencia' => $subtotal_asistencia,
            'subtotal_biblia' => $subtotal_biblia,
            'total_completo' => $total_completo
        );
    } else {
        // No se encontraron puntos para el usuario
        $response = array(
            'status' => 'error',
            'message' => 'No se encontraron puntos para el usuario especificado'
        );
    }
} else {
    // No se ha recibido el parámetro id_user, enviar un mensaje de error
    $response = array(
        'status' => 'error',
        'message' => 'El parámetro id_user es obligatorio'
    );
}

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cerrar la conexión a la base de datos
$stmt->close();
$conexion->close();

?>
