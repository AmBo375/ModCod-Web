<?php
require_once '../dbConnect.php';

if (isset($_POST['submit'])){
    $ref = $_POST['ref'];
    $refM = $_POST['refM'];
    $obj = $_POST['obj'];
    $limit  = $_POST['limit'];
    $prosp = $_POST['prosp'];
    $limit  = $_POST['caution'];
    $prosp = $_POST['execDelay'];
    $edit  = $_POST['edit'];
    $context = $_POST['context'];

    $sql = "INSERT INTO pec(ref, refM, obj, dateLimit, caution, execDelay, prosp, edit, context) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stm = $conn->prepare($sql);
    $stm->bind_param("sssssssss", $ref, $refM, $obj, $limit, $caution, $execDelay, $prosp, $edit, $context);
    $success = $stm->execute();
    if ($success) {
        echo "New records created successfully";
    }
    $stm->close();
}
$conn->close();
