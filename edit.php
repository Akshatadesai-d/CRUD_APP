<?php
include 'config.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM items WHERE id=$id");
$item = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];

    if (!empty($name) && is_numeric($quantity)) {
        $stmt = $conn->prepare("UPDATE items SET name=?, quantity=? WHERE id=?");
        $stmt->bind_param("sii", $name, $quantity, $id);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Item</title>
</head>
<body>
    <h1>Update Item</h1>
    <form method="POST">
        <input type="text" name="name" value="<?php echo $item['name']; ?>" required>
        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" required>
        <button type="submit">Update</button>
    </form>
</body>
</html>
