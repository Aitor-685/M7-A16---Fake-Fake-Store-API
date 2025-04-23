<?php
include("includes/head.html");
include("includes/menu.php");

if(!isset($_REQUEST['categoria']) || $_REQUEST['categoria']=="" || $_REQUEST['categoria']=="totes"){
    $categoria = "totes";
    $url = "php/productes.php"; 
} else {
    $categoria = $_REQUEST['categoria'];
    $url = "{url de la vostra API}/productes.php?category=" . rawurlencode($categoria);
}
?>

<div class="container">
    <h3>PRODUCTES DE LA CATEGORIA - <?php echo ucfirst($categoria); ?>:</h3>

    <?php
        $response = file_get_contents($url);
    $data = json_decode($response, true);

        if ($data && is_array($data)) {
        echo "<div class='llistat-productes'>";
        foreach ($data as $product) {
            echo "<div class='producte-mini'>";
            echo "<img src='" . htmlspecialchars($product['image']) . "' alt='Imatge del producte'>";
            echo "<div><a href='veureProducte.php?id=" . urlencode($product['id']) . "'>" . htmlspecialchars($product['name']) . "</a></div>";
            echo "<div class='preu'>$" . htmlspecialchars($product['price']) . "</div>";
            echo "<div class='rating'>" . htmlspecialchars($product['rating']) . " (" . htmlspecialchars($product['recuento']) . " valoracions)</div>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>Error al obtenir les dades de l'API.</p>";
    }
    ?>
</div>

<?php
include("includes/foot.html");
?>
