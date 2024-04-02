<?php

if (empty($_POST["placename"])) {
    die("PlaceName is required");
}

if (empty($_POST["tourist"])) {
    die("Tourist number is required");
}
if (empty($_POST["arrival"])) {
    die("Date of arrival is required");
}
if (empty($_POST["leaving"])) {
    die("Leaving date is required");
}

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO bookings (placename, tourist, arrival, leaving)
        VALUES (?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss",
                  $_POST["placename"],
                  $_POST["tourist"],
                  $_POST["arrival"],
                  $_POST["leaving"],);
                  

                  if ($stmt->execute()) {

                    header("Location: booking-success.html");
                    exit;
                    
                } else {
                    
                    if ($mysqli->errno === 1062) {
                        die("email already taken");
                    } else {
                        die($mysqli->error . " " . $mysqli->errno);
                    }
                }







