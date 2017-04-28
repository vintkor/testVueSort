<?php

$productsArray = [
    [
        'id' => 1,
        'title' => 'Product 24',
        'price' => 300,
        'date' => '12.04.2016',
    ],
    [
        'id' => 2,
        'title' => 'Product 26',
        'price' => 457,
        'date' => '13.04.2017',
    ],
    [
        'id' => 3,
        'title' => 'Product 32',
        'price' => 700,
        'date' => '12.04.2012',
    ],
    [
        'id' => 4,
        'title' => 'Product 47',
        'price' => 139,
        'date' => '30.05.2017',
    ],
    [
        'id' => 5,
        'title' => 'Product 52',
        'price' => 700,
        'date' => '12.04.2012',
    ],
    [
        'id' => 6,
        'title' => 'Product 23',
        'price' => 139,
        'date' => '22.05.2014',
    ],
    [
        'id' => 7,
        'title' => 'Product 43',
        'price' => 87,
        'date' => '18.04.2012',
    ],
    [
        'id' => 8,
        'title' => 'Product 4',
        'price' => 5456,
        'date' => '30.08.2013',
    ],
];

require_once "SortingProduct.php";

if (isset($_GET['sort'])) {

    $sort = $_GET['sort'];
    switch ($sort) {

        case 'date':
            $products = SortingProduct::getSortedProduct($productsArray, 'date');
            break;
        case 'price':
            $products = SortingProduct::getSortedProduct($productsArray, 'price');
            break;
        case 'title':
            $products = SortingProduct::getSortedProduct($productsArray, 'title');
            break;
        case 'id':
            $products = SortingProduct::getSortedProduct($productsArray, 'id');
            break;
        default:
            $products = SortingProduct::getSortedProduct($productsArray, 'id');
    }

    header('Content-Type: application/json');
    echo json_encode( $products );

} elseif (isset($_GET['id'])) {

    $id = $_GET['id'];
    $product = SortingProduct::getSingle($productsArray, $id);

    header('Content-Type: application/json');
    echo json_encode( $product );

}