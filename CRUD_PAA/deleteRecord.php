<?php
    include_once '../dbConnect.php';
    $sql = "DELETE FROM paa WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET["id"]);
    $success = $stmt->execute();
    if ($success) {
        header("location: paa.php");
    } else {
        echo "<p>Not Deleted<p>";
    }

