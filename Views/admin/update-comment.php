<?php
// update-comment.php

// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_dbname";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from the form
$comment_id = $_POST['id'];
$author = $_POST['author'];
$content = $_POST['content'];

// Update the comment in the database
$sql = "UPDATE comments SET author = ?, content = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $author, $content, $comment_id);

if ($stmt->execute()) {
    header("Location: /admin/comments.php"); // Redirect to the comments management page
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
