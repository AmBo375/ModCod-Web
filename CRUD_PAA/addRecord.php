<?php
require_once '../dbConnect.php';

if (isset($_POST['submit'])){
    $ref = $_POST['ref'];
    $refM = $_POST['refM'];
    $obj = $_POST['obj'];
    $limit  = $_POST['limit'];
    $prosp = $_POST['prosp'];
    $edit  = $_POST['edit'];
    $context = $_POST['context'];

    $sql = "INSERT INTO paa(ref, refM, obj, dateLimit, prosp, edit, context) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stm = $conn->prepare($sql);
    $stm->bind_param("sssssss", $ref, $refM, $obj, $limit, $prosp, $edit, $context);
    $success = $stm->execute();
    if ($success) {
        echo "New records created successfully";
    }
    $stm->close();
}
$conn->close();
