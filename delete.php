<?php
include "db_connect.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    // Using prepared statement for security
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: view_books.php?msg=deleted");
    } else {
        header("Location: view_books.php?msg=error");
    }
} else {
    header("Location: view_books.php");
}
exit();
?>
