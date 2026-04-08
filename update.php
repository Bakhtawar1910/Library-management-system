<?php
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id     = $_POST["id"];
    $title  = trim($_POST["title"]);
    $author = trim($_POST["author"]);
    $price  = filter_var($_POST["price"], FILTER_VALIDATE_FLOAT);

    if ($id && $title && $author && $price !== false) {
        $stmt = $conn->prepare("UPDATE books SET title=?, author=?, price=? WHERE id=?");
        $stmt->bind_param("ssdi", $title, $author, $price, $id);
        
        if ($stmt->execute()) {
            header("Location: view_books.php?msg=updated");
        } else {
            header("Location: edit.php?id=$id&msg=error");
        }
    } else {
        header("Location: edit.php?id=$id&msg=invalid");
    }
} else {
    header("Location: view_books.php");
}
exit();
?>
