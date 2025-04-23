<?php
include("includes/head.html");
include("includes/menu.php");
?>

<div class="container">
    <h3>CATEGORIES:</h3>

    <?php
    $url = "php/productes.php?categories=all";
    $response = file_get_contents($url);
    $data = json_decode($response);

    if ($data && is_array($data)) {
        echo "<ul class='categories'>";
        foreach ($data as $category) {
            echo "<li><a href='veureProductesCategoria.php?categoria=" . urlencode($category) . "'>" . htmlspecialchars($category) . "</a></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Error a l'obtenir les dades de l'API.</p>";
    }
    ?>
</div>

<?php
include("includes/foot.html");
?>