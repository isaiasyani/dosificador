<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dosificador_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT * FROM pedidos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($rows);
    } else {
        echo "No se encontraron resultados";
    }
} else {
    echo "Método no admitido";
}

$conn->close();

?>
