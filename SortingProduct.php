<?php

class SortingProduct
{
    private static $products;

    private static function sort($data, $sortColumn)
    {
        $items = array();
        foreach ($data as $key => $value) {
            $items[$key] = $value[$sortColumn];
        }
        return $items;
    }

    /**
     * @param $productsArray
     * @param string $sortColumn
     * @return array sorted by $sortColumn
     */
    public static function getSortedProduct($productsArray, $sortColumn = 'id')
    {
        self::$products = $productsArray;
        $temp = self::sort(self::$products, $sortColumn);
        array_multisort($temp, SORT_NATURAL, self::$products);
        return self::$products;
    }
}