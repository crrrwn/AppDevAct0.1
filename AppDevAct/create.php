<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello My Crud</title>
</head>
<body>
    <form action="" method="POST">
    <?php
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $createdat = $_POST['createdat'];
            $updatedat = $_POST['updatedat'];

            // Prepare SQL statement
            $sql = 'INSERT INTO products (Name, Description, Price, Quantity, ToCreate, ToUpdate) VALUES (?, ?, ?, ?, ?, ?)';

            if ($stmt = $conn->prepare($sql)) {
                // Bind parameters
                $stmt->bind_param("ssdiis", $name, $description, $price, $quantity, $createdat, $updatedat);

                // Execute statement
                if ($stmt->execute()) {
                    echo "<div>User Data Saved Successfully</div>";
                } else {
                    echo "<div>Oops, something went wrong!</div>";
                }

                // Close statement
                $stmt->close();
            } else {
                echo "<div>Prepare failed: " . $conn->error . "</div>";
            }
        }
    ?>
    <h2>PRODUCTS</h2>

    <div>
        <label>Name</label>
        <input type="text" placeholder="Enter Product Name" name="name" autocomplete="off">
    </div><br>
    <div>
        <label>Description</label>
        <input type="text" placeholder="Enter Product Description" name="description" autocomplete="off">
    </div><br>
    <div>
        <label>Price</label>
        <input type="text" placeholder="Enter Product Price" name="price" autocomplete="off">
    </div><br>
    <div>
        <label>Quantity</label>
        <input type="text" placeholder="Enter Product Quantity" name="quantity" autocomplete="off">
    </div><br>
    <div>
        <label>Created At</label>
        <input type="datetime-local" placeholder="Created At" name="createdat" autocomplete="off">
    </div><br>
    <div>
        <label>Updated At</label>
        <input type="datetime-local" placeholder="Updated At" name="updatedat" autocomplete="off">
    </div><br>
    <button type="submit" name="submit">Save</button><br>
    <a href="retrieve.php" role="button">Retrieve Data</a>
    </form>
</body>
</html>