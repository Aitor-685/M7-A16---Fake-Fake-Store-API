<?php
header('Content-Type: application/json');

require_once 'conexxio.php';

try {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $db->prepare('SELECT * FROM productes WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        $product = $result->fetchArray(SQLITE3_ASSOC);
        echo json_encode($product);
        exit;
    }

    if (isset($_GET['categoria']) && $_GET['categoria'] === 'all') {
        $result = $db->query('SELECT DISTINCT categoria FROM productes');
        $categories = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $categories[] = $row['categoria'];
        }
        echo json_encode($categories);
        exit;
    }

    $result = $db->query('SELECT * FROM productes');
    $productes = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $productes[] = $row;
    }
    echo json_encode($productes);

} catch (Exception $e) {
    echo json_encode(['error' => 'Error de base de dades: ' . $e->getMessage()]);
    exit;
}
?>