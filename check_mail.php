<?php
header('Content-Type: application/json');
include('include/db.php');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['email'])) {
    $email = $data['email'];
    $stmt = $conn->prepare("SELECT COUNT(*) FROM admin WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $exists = $stmt->fetchColumn() > 0;

    echo json_encode(['exists' => $exists]);
    exit;
}

echo json_encode(['error' => 'Email manquant.']);
exit;
?>
