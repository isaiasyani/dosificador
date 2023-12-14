<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dosificador";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql_last_order = "SELECT MAX(num_pedido) AS last_order FROM pedidos";
    $result = $conn->query($sql_last_order);
    $last_order = 6; 
    if ($result && $row = $result->fetch_assoc()) {
        $last_order = $row['last_order'] + 1; 
    }

    $cantidad = $_POST['cantidad'];
    $id_producto = $_POST['id_producto'];

    $sql = "INSERT INTO pedidos (num_pedido, cantidad, id_producto) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la consulta: " . $conn->error);
    }

    $stmt->bind_param("iii", $last_order, $cantidad, $id_producto);
    if ($stmt->execute() === true) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
