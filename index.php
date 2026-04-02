<?php
$host = getenv('DB_HOST') ?: 'db';
$user = getenv('DB_USER') ?: 'phpuser';
$pass = getenv('DB_PASS') ?: 'secret';
$name = getenv('DB_NAME') ?: 'shop';

$conn = new mysqli($host, $user, $pass, $name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM products ORDER BY id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; }
        table { border-collapse: collapse; width: 100%; max-width: 600px; }
        th, td { border: 1px solid #ccc; padding: 0.6rem 1rem; text-align: left; }
        th { background: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Products</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <th><?= $row['id'] ?></th>
            <td style="color:red"><?= $row['name'] ?></td>
            <td>$<?= number_format($row['price'], 2) ?></td>
            <td><?= $row['stock'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>