<?php


require 'conexion.php';


if(isset($_GET['id_rol'], $_GET['fecha'])) {

    $id_rol = $_GET['id_rol'];
    $fecha = $_GET['fecha'];


    $sql = "SELECT Users.user_id, Users.user_nombres, Users.user_apellidos, Users.user_dni, Users.user_foto, Puntos.puntos_participacion, Puntos.puntos_asistencia, Puntos.puntos_biblia, Puntos.puntos_fecha
            FROM Users
            LEFT JOIN Puntos ON Users.user_id = Puntos.id_user AND Puntos.puntos_fecha = ?
            WHERE Users.id_rol = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $fecha, $id_rol);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        
        $users = array();


        while($row = $result->fetch_assoc()) {
            $users[] = array(
                'user_id' => $row['user_id'],
                'user_nombres' => $row['user_nombres'],
                'user_apellidos' => $row['user_apellidos'],
                'user_dni' => $row['user_dni'],
                'user_foto' => $row['user_foto'],
                'puntos_participacion' => $row['puntos_participacion'],
                'puntos_asistencia' => $row['puntos_asistencia'],
                'puntos_biblia' => $row['puntos_biblia'],
                'puntos_fecha' => $row['puntos_fecha']
            );
        }


        $response = array(
            'status' => 'success',
            'data' => $users
        );
    } else {
        
        $response = array(
            'status' => 'error',
            'message' => 'No se encontraron usuarios con el id_rol especificado'
        );
    }
} else {
    
    $response = array(
        'status' => 'error',
        'message' => 'Los parámetros id_rol y fecha son obligatorios'
    );
}


header('Content-Type: application/json');
echo json_encode($response);


$stmt->close();
$conexion->close();

?>
