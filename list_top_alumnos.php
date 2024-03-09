<?php

require 'conexion.php';

    $sql = "SELECT u.user_nombres, u.user_apellidos, u.user_foto, SUM(p.puntos_participacion + p.puntos_asistencia + p.puntos_biblia) AS total_puntos
            FROM Puntos p
            INNER JOIN Users u ON p.id_user = u.user_id
            GROUP BY p.id_user
            ORDER BY total_puntos DESC
            LIMIT 4";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        
        $users = array();


        while($row = $result->fetch_assoc()) {
            $users[] = array(
                'user_nombres' => $row['user_nombres'],
                'user_apellidos' => $row['user_apellidos'],
                'user_foto' => $row['user_foto'],
                'total_puntos' => $row['total_puntos']
            );
        }


        $response = array(
            'status' => 'success',
            'data' => $users
        );
    } else {
        
        $response = array(
            'status' => 'error',
            'message' => 'Los alumnos no tienen puntos registrados'
        );
    }



header('Content-Type: application/json');
echo json_encode($response);


$stmt->close();
$conexion->close();

?>
