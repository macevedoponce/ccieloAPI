<?php


require 'conexion.php';

if(isset($_POST['id_user'], $_POST['puntos_participacion'], $_POST['puntos_asistencia'], $_POST['puntos_biblia'], $_POST['puntos_fecha'])) {

    $id_user = $_POST['id_user'];
    $puntos_participacion = $_POST['puntos_participacion'];
    $puntos_asistencia = $_POST['puntos_asistencia'];
    $puntos_biblia = $_POST['puntos_biblia'];
    $puntos_fecha = $_POST['puntos_fecha'];


    $sql = "SELECT * FROM Puntos WHERE id_user = ? AND puntos_fecha = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("is", $id_user, $puntos_fecha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $updateSql = "UPDATE Puntos SET puntos_participacion = ?, puntos_asistencia = ?, puntos_biblia = ? WHERE id_user = ? AND puntos_fecha = ?";
        $updateStmt = $conexion->prepare($updateSql);
        $updateStmt->bind_param("iiiis", $puntos_participacion, $puntos_asistencia, $puntos_biblia, $id_user, $puntos_fecha);

        if ($updateStmt->execute()) {
            $response = array(
                'status' => 'success',
                'message' => 'Registro actualizado exitosamente'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Error al actualizar el registro'
            );
        }
    } else {
 
        $insertSql = "INSERT INTO Puntos (puntos_participacion, puntos_asistencia, puntos_biblia, puntos_fecha, id_user) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $conexion->prepare($insertSql);
        $insertStmt->bind_param("iiiss", $puntos_participacion, $puntos_asistencia, $puntos_biblia, $puntos_fecha, $id_user);

        if ($insertStmt->execute()) {
            $response = array(
                'status' => 'success',
                'message' => 'Registro creado exitosamente'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Error al crear el registro'
            );
        }
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
