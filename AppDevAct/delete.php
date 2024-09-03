<?php
include 'config.php'; // Include database connection file

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id) {
    $sql = 'DELETE FROM products WHERE ID = ?';
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<div>Product deleted successfully</div>";
        } else {
            echo "<div>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        echo "<div>Error preparing statement: " . $conn->error . "</div>";
    }
}

?>
<a href="retrieve.php">Back to Product List</a>
