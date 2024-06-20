<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Method Not Allowed";
    exit();
}

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$question = $_POST['question'];
$contact = $_POST['contact'];

$conn = new mysqli('localhost', 'root', '', 'info');

if ($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO info (firstName, lastName, email, phone, question, contact) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $phone, $question, $contact);
    if ($stmt->execute()) {
        echo "Ati trimis datele cu success.";
    } else {
        echo "Eroare: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>