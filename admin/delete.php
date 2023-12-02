<?php

require '../config/config.php';

$id = $_GET['id'];
$stmt= $pdo->prepare("DELETE From posts where id=?");
$stmt->execute([$id]);

header('Location: index.php');

?>