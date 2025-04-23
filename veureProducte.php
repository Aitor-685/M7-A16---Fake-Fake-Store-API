<?php
include("includes/head.html");
include("includes/menu.php");

if (!isset($_REQUEST['id']) || $_REQUEST['id'] == "") {
    header("location: index.php");
    exit;
}
?>

<div class="container">
    <h3>PRODUCTE:</h3>

    <?php
    $url = "php/productes.php?id=" . urlencode($_REQUEST['id']);
    $response = file_get_contents($url);
    $product = json_decode($response, true);

    if ($product && is_array($product)) {
        echo "<div class='producte'>";
        echo "<img src='" . htmlspecialchars($product['image']) . "' alt='Imatge del producte'>";
        echo "<div class='producte-info'>";
        echo "<h4>" . htmlspecialchars($product['name']) . "</h4>";
        echo "<p class='preu'>Preu: $" . htmlspecialchars($product['price']) . "</p>";
        echo "<p>" . htmlspecialchars($product['descripcio']) . "</p>";
        echo "<p class='categoria'>Categoria: <a href='veureProductesCategoria.php?categoria=" . urlencode($product['categoria']) . "'>" . htmlspecialchars($product['categoria']) . "</a></p>";
        echo "<p class='rating'>Puntuació: " . htmlspecialchars($product['rating']) . " (" . htmlspecialchars($product['recuento']) . " valoracions)</p>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<p>Error a l'obtenir les dades de l'API.</p>";
    }
    ?>
</div>

<?php
include("includes/foot.html");
?>
