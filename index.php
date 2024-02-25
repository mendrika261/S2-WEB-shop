<?php

session_start();

// inclusion de la liste de donnnees
include 'data/data.php';

// recuperation des listes des produits a afficher
include 'function.php';
$numCategory = count($category); // nombre de categorie
if(isset($_GET['category']) AND $_GET['category'] < $numCategory AND $_GET['category'] >= 0) {
    $iCat = $_GET['category'];
    $catProduct = getDetailCategory($_GET['category'], $product);
    $numProduct = count($catProduct); // nombre de produit dans la categorie
}
else //sinon on afficher la liste dans categorie 0
    header('Location:index.php?category=0');


// s'il y a eu un achat
if(isset($_GET['achat'])) {
    $achat = $_GET['achat'];
    addProduct($iCat, $achat, $catProduct);
}

//inclusion de l'en tete de la page
include 'page/header.php';
?>

<div class="content">
    <div class="nav">
        <h1>
            <span><i class="fas fa-bars"></i> Category</span>
            <span><i class="fas fa-angle-up"></i></span>
        </h1>
        <ul>
            <?php for($i=0; $i<$numCategory; $i++) { ?>
                <li><a href="?category=<?php echo $i; ?>"><?php echo $category[$i]; ?></a></li>
            <?php } ?>
        </ul>
    </div>

    <div class="category-content">
        <div class="title">
            <h2>Category: <?php echo $category[$iCat] ?> </h2>
            <p>Showing all : <?php echo $numProduct ?> result(s)</p>
            <?php if(!empty($_SESSION['message'])) { ?>
            <p class="message">
                <?php echo $_SESSION['message']; $_SESSION['message'] = ""; ?>
                <i class="fas fa-basket-shopping"></i>
            </p>
            <?php } ?>
        </div>
        <div class="list">
            <?php for($iProd = 0; $iProd<$numProduct; $iProd++) { ?>
                    <div class="card">
                        <img src="<?php echo $catProduct[$iProd]['img'] ?>" alt="Loading...">
                        <p><?php echo $catProduct[$iProd]['name'] ?></p>
                        <a class="price" href="index.php?category=<?php echo $iCat ?>&amp;achat=<?php echo $iProd ?>">
                            <i class="fas fa-bank"></i>
                            <?php if($catProduct[$iProd]['discount'] != 0) { ?>
                                <span class="price-bar">$<?php echo number_format($catProduct[$iProd]['discount'], 2) ?></span>
                            <?php } ?>
                            $<?php echo number_format($catProduct[$iProd]['prix'], 2) ?>
                        </a>
                    </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php

// inclusion de la fin de page
include 'page/footer.php';