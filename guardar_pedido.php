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
    // Utilizar sentencias preparadas para prevenir la inyección de SQL
    $cantidad = mysqli_real_escape_string($conn, $_POST['cantidad']);

    // Consulta preparada para insertar en la tabla pedidos
    $sql = "INSERT INTO pedidos (cantidad) VALUES (?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Asociar parámetros y ejecutar la consulta
        $stmt->bind_param("s", $cantidad);

        if ($stmt->execute()) {
            echo "Cantidad insertada correctamente en la tabla pedidos";
        } else {
            echo "Error al insertar la cantidad en la tabla pedidos: " . $stmt->error;
        }

        // Cerrar la consulta preparada
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }
} else {
    echo "La cantidad no está definida en el formulario.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
