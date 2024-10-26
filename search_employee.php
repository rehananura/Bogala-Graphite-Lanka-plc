<?php
include 'db.php';

try {
    if (isset($_GET['query'])) {
        $query = $_GET['query'];

        // Prepare and execute a query to find employees with names similar to the input
        $stmt = $pdo->prepare('SELECT name FROM employees WHERE name LIKE ? LIMIT 10');
        $stmt->execute(['%' . $query . '%']);
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the results as a JSON array
        echo json_encode($employees);
    } else {
        echo json_encode(['error' => 'No query parameter provided.']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
