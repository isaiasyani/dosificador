<?php

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dosificador_db";

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Recibir la petición (puedes ajustar esta parte según tus necesidades)
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Ejemplo: Obtener todos los registros de una tabla llamada "ejemplo"
    $sql = "SELECT * FROM pedidos";
    $result = $conn->query($sql);

    // Verificar si se obtuvieron resultados
    if ($result->num_rows > 0) {
        // Convertir resultados a un array asociativo
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        // Devolver los resultados como JSON (puedes ajustar el formato según lo que necesites)
        header('Content-Type: application/json');
        echo json_encode($rows);
    } else {
        // No se encontraron resultados
        echo "No se encontraron resultados";
    }
} else {
    // Método no admitido
    echo "Método no admitido";
}

// Cerrar conexión a la base de datos
$conn->close();

?>