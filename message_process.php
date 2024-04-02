<?php

if (empty($_POST["name"])) {
    die("Name is required");
}
if (empty($_POST["email"])) {
    die("Your email is required");
}
if (empty($_POST["tourist"])) {
    die("Tourist number is required");
}

if (empty($_POST["subject"])) {
    die("Subject is required");
}
if (empty($_POST["message"])) {
    die("Please write a message ");
}

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO messages (name, email, tourist, subject, message)
        VALUES (?, ?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssss",
                  $_POST["name"],
                  $_POST["email"],
                  $_POST["tourist"],
                  $_POST["subject"],
                  $_POST["message"],);
                  

                  if ($stmt->execute()) {

                   header("Location: message-success.html");
                    exit;
                    
                } else {
                    
                    if ($mysqli->errno === 1062) {
                        die("email already taken");
                    } else {
                        die($mysqli->error . " " . $mysqli->errno);
                    }
                }







