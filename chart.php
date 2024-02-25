<?php

session_start();

// inclusion de la liste de donnnees
include 'data/data.php';

// inclusion des fonction utile
include 'function.php';

// nouveau panier si reset et panier non existant
if(isset($_GET['reset']) || !isset($_SESSION['chart']))
    newChart();

// Recuperation des produits dans le panier
$myChart = getAllProduct($_SESSION['chart'], $product);
$numChart = count($myChart);

// inclusion de l'en tete
include 'page/header.php';

?>

    <div class="content">
        <div class="title">
            <h2>My chart </h2>
            <p>Showing all : <?php echo $numChart ?> Product(s)</p>
            <?php if(isset($message)) { ?>
                <p class="message">
                    <?php echo $message ?>
                    <i class="fas fa-basket-shopping"></i>
                </p>
            <?php } ?>
            <ul>
                <li>TOTAL: $<?php echo totalPrice($myChart) ?></li>
                <li><a href="?reset">Reset</a></li>
            </ul>
        </div>
        <div class="list">
            <?php for($iProd = 0; $iProd<$numChart; $iProd++) { ?>
                <div class="card">
                    <img src="<?php echo $myChart[$iProd]['img'] ?>" alt="Loading...">
                    <p><?php echo $myChart[$iProd]['name'] ?></p>
                    <p class="price">
                        <i class="fas fa-remove"></i>
                        $<?php echo number_format($myChart[$iProd]['prix'], 2) ?>
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>

<?php
// inclusion du footer
include 'page/footer.php';
