<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];

    if (!empty($name) && is_numeric($quantity)) {
        $stmt = $conn->prepare("INSERT INTO items (name, quantity) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $quantity);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: index.php");
}
?>
