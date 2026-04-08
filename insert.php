<?php 
include "db_connect.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]); 
    $author = trim($_POST["author"]); 
    $price = filter_var($_POST["price"], FILTER_VALIDATE_FLOAT); 

    if ($title && $author && $price !== false) {
        $stmt = $conn->prepare("INSERT INTO books (title, author, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $title, $author, $price);
        
        if ($stmt->execute()) {
            header("Location: view_books.php?msg=added"); 
        } else {
            header("Location: add_book.php?msg=error");
        }
    } else {
        header("Location: add_book.php?msg=invalid");
    }
} else {
    header("Location: view_books.php");
}
?>
