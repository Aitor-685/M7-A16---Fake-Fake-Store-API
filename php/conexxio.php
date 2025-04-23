<?php
try {
    $db = new SQLite3(__DIR__ . "/../api/store.db");
} catch (Exception $e) {
    die("Error de connexió a la base de dades: " . $e->getMessage());
}
?>