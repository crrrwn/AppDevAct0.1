<?php
include 'config.php'; // Include database connection file

// Fetch products
$sql = 'SELECT * FROM products';
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Products</title>
</head>
<body>
    <h2>Product List</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Description']; ?></td>
                <td><?php echo $row['Price']; ?></td>
                <td><?php echo $row['Quantity']; ?></td>
                <td><?php echo $row['ToCreate']; ?></td>
                <td><?php echo $row['ToUpdate']; ?></td>
                <td>
                    <a href="update.php?id=<?php echo $row['ID']; ?>">Edit</a> |
                    <a href="delete.php?id=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="create.php">Add New Product</a>
</body>
</html>
