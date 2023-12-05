<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dosificador_db";

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if(isset($_POST['cantidad'])) {
    $cantidad = $_POST['cantidad'];

    // Consulta para insertar solo en el campo cantidad en la tabla pedidos
    $sql = "INSERT INTO pedidos (cantidad) VALUES ('$cantidad')";

    if ($conn->query($sql) === TRUE) {
        echo "Cantidad insertada correctamente en la tabla pedidos";
    } else {
        echo "Error al insertar la cantidad en la tabla pedidos: " . $conn->error;
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
