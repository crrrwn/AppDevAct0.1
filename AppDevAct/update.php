<?php
include 'config.php'; // Include database connection file

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $createdat = $_POST['createdat'];
    $updatedat = $_POST['updatedat'];

    $sql = 'UPDATE products SET Name = ?, Description = ?, Price = ?, Quantity = ?, ToCreate = ?, ToUpdate = ? WHERE ID = ?';

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssdiisi", $name, $description, $price, $quantity, $createdat, $updatedat, $id);

        if ($stmt->execute()) {
            echo "<div>Product updated successfully</div>";
        } else {
            echo "<div>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        echo "<div>Error preparing statement: " . $conn->error . "</div>";
    }
}

// Fetch product for editing
$sql = 'SELECT * FROM products WHERE ID = ?';
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>
<body>
    <form action="" method="POST">
    <h2>Update Product</h2>
    <div>
        <label>Name</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['Name']); ?>" required>
    </div><br>
    <div>
        <label>Description</label>
        <input type="text" name="description" value="<?php echo htmlspecialchars($product['Description']); ?>" required>
    </div><br>
    <div>
        <label>Price</label>
        <input type="number" name="price" value="<?php echo htmlspecialchars($product['Price']); ?>" step="0.01" required>
    </div><br>
    <div>
        <label>Quantity</label>
        <input type="number" name="quantity" value="<?php echo htmlspecialchars($product['Quantity']); ?>" required>
    </div><br>
    <div>
        <label>Created At</label>
        <input type="datetime-local" name="createdat" value="<?php echo htmlspecialchars($product['ToCreate']); ?>" readonly>
    </div><br>
    <div>
        <label>Updated At</label>
        <input type="datetime-local" name="updatedat" value="<?php echo htmlspecialchars($product['ToUpdate']); ?>" required>
    </div><br>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit">Update</button><br>
    <a href="retrieve.php">View Products</a>
    </form>
</body>
</html>
