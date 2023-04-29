<?php
// update-post.php

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
$post_id = $_POST['id'];
$title = $_POST['title'];
$body = $_POST['body'];

// Update the post in the database
$sql = "UPDATE posts SET title = ?, body = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $title, $body, $post_id);

if ($stmt->execute()) {
  header("Location: /admin/posts.php"); // Redirect to the posts management page
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
