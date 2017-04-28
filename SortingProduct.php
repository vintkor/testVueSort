<?php

class SortingProduct
{
    private static $products;
    private static $product;

    private static function sort($data, $sortColumn)
    {
        $items = array();
        foreach ($data as $key => $value) {
            $items[$key] = $value[$sortColumn];
        }
        return $items;
    }

    public static function getSortedProduct($productsArray, $sortColumn = 'id')
    {
        self::$products = $productsArray;
        $temp = self::sort(self::$products, $sortColumn);
        array_multisort($temp, SORT_NATURAL, self::$products);
        return self::$products;
    }

    public static function getSingle($productArray, $id)
    {
        self::$products = $productArray;
        foreach (self::$products as $item) {
            if($item['id'] == $id) {
                self::$product = $item;
                break;
            }
        }
        return self::$product;
    }
}