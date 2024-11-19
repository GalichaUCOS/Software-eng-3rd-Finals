<?php
require_once 'dbConfig.php';

function insertApplicant($data) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO applicants (first_name, last_name, email, phone, address, qualifications) 
                               VALUES (:first_name, :last_name, :email, :phone, :address, :qualifications)");
        $stmt->execute([
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':qualifications' => $data['qualifications']
        ]);
        return [
            'message' => 'Applicant added successfully.',
            'statusCode' => 200
        ];
    } catch (Exception $e) {
        return [
            'message' => 'Error: ' . $e->getMessage(),
            'statusCode' => 400
        ];
    }
}

function readApplicants() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM applicants");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return [
            'message' => 'Applicants retrieved successfully.',
            'statusCode' => 200,
            'querySet' => $results
        ];
    } catch (Exception $e) {
        return [
            'message' => 'Error: ' . $e->getMessage(),
            'statusCode' => 400,
            'querySet' => []
        ];
    }
}

function updateApplicant($id, $data) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE applicants 
                               SET first_name = :first_name, last_name = :last_name, email = :email, 
                                   phone = :phone, address = :address, qualifications = :qualifications
                               WHERE id = :id");
        $stmt->execute([
            ':id' => $id,
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':qualifications' => $data['qualifications']
        ]);
        return [
            'message' => 'Applicant updated successfully.',
            'statusCode' => 200
        ];
    } catch (Exception $e) {
        return [
            'message' => 'Error: ' . $e->getMessage(),
            'statusCode' => 400
        ];
    }
}

function deleteApplicant($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM applicants WHERE id = :id");
        $stmt->execute([':id' => $id]);
        
        return [
            'message' => 'Applicant deleted successfully.',
            'statusCode' => 200
        ];
    } catch (Exception $e) {
        return [
            'message' => 'Error: ' . $e->getMessage(),
            'statusCode' => 400
        ];
    }
}

function searchApplicants($searchQuery) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM applicants 
                               WHERE first_name LIKE :search 
                               OR last_name LIKE :search 
                               OR email LIKE :search 
                               OR phone LIKE :search 
                               OR address LIKE :search 
                               OR qualifications LIKE :search");
        $stmt->execute([':search' => '%' . $searchQuery . '%']);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return [
            'message' => 'Applicants retrieved successfully.',
            'statusCode' => 200,
            'querySet' => $results
        ];
    } catch (Exception $e) {
        return [
            'message' => 'Error: ' . $e->getMessage(),
            'statusCode' => 400,
            'querySet' => []
        ];
    }
}
?>
