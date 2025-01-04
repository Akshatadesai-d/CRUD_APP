

<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD Application</title>
    <link rel="stylesheet" href="style.css">


    
</head>
<body>
    <h1>PHP CRUD APPLICATION</h1>

    <!-- Form to Add Item -->
    <form action="add.php" method="POST">
        <input type="text" name="name" placeholder="Item Name" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <button type="submit">Add Item</button>
    </form>

    <!-- Display Items -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM items");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['quantity']}</td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Edit</a>
                        <a href='delete.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
    <canvas id="myChart"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const data = {
        labels: [<?php
            $result = $conn->query("SELECT name FROM items");
            while ($row = $result->fetch_assoc()) {
                echo "'{$row['name']}',";
            }
        ?>],
        datasets: [{
            label: 'Quantity',
            data: [<?php
                $result = $conn->query("SELECT quantity FROM items");
                while ($row = $result->fetch_assoc()) {
                    echo "{$row['quantity']},";
                }
            ?>],
            backgroundColor: 'rgba(75, 192, 192, 0.6)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>

</body>
</html>
