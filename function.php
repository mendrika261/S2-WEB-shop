<?php

function getDetailCategory($category, $product) {
    $result = NULL;
    $iRes = 0;
    foreach ($product as $elem) {
        if($elem['category'] == $category) {
            $result[$iRes] = $elem;
            $iRes++;
        }
    }
    return $result;
}

function getProduct($category, $iProduct, $product) {
    $listCat = getDetailCategory($category, $product);
    return $listCat[$iProduct];
}

function getAllProduct($chart, $product) {
    $res[] = NULL;
    for($i=0; $i<count($chart); $i++) {
       $res[$i] = getProduct($chart[$i]['category'], $chart[$i]['product'], $product);
    }
    return $res;
}

function newChart() {
    session_destroy();
    header('Location:index.php?m=new');
}

function addProduct($iCat, $achat, $catProduct) {
    $addProduct = array(
        'category' => $iCat,
        'product' => $achat
    );

    $_SESSION['chart'][] = $addProduct;
    $_SESSION['message'] = "Vous avez ajouter 1 ".$catProduct[$achat]['name']." a votre panier!";
}

function totalPrice($chart) {
    $res = 0;
    for($i=0; $i<count($chart); $i++) {
        $res = $res + $chart[$i]['prix'];
    }
    return $res;
}