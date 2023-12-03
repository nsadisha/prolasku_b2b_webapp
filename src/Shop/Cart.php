<?php

namespace Hlakioui\Shop;

use Hlakioui\API\CmsApi;

/**
 *
 */
class Cart
{

    /**
     * @param int $pId
     * @param int $qty
     * @param string $name
     * @param float $price
     */
    public function addItem(int $pId, int $qty, string $name, float $price, $location_id=false, $shelf_id=false, $best_before_date=false, $stock=0): void
    {
    	if(isset($_SESSION["shopping_cart"][$pId]) && !empty($_SESSION["shopping_cart"][$pId])):	
	        if (empty($price)) {
	            $price = $_SESSION["shopping_cart"][$pId]['price'];
	        }

	        if (empty($name)) {
	            $name = $_SESSION["shopping_cart"][$pId]['name'];
	        }
	        
            $oldQty = $_SESSION["shopping_cart"][$pId]['qty'];
            $qty = $oldQty + $qty;
       endif;

        $_SESSION["shopping_cart"][$pId] = [
            'id' => $pId,
            'qty' => $qty,
            'name' => $name,
            'price' => $price,
            'location_id' => $location_id,
            'shelf_id' => $shelf_id,
            'best_before_date' => $best_before_date,
            'stock' => $stock,
        ];
    }

    /**
     * @param int $pId
     * @param int $qty
     * @param string $name
     * @param float $price
     */
    public function updateDate(int $pId, int $qty, string $name, float $price): void
    {
	     if(isset($_SESSION["shopping_cart"][$pId]) && !empty($_SESSION["shopping_cart"][$pId])):	
	        if (empty($price)) {
	            $price = $_SESSION["shopping_cart"][$pId]['price'];
	        }

	        if (empty($name)) {
	            $name = $_SESSION["shopping_cart"][$pId]['name'];
	        }
	    endif;

        $_SESSION["shopping_cart"][$pId] = [
            'id' => $pId,
            'qty' => $qty,
            'name' => $name,
            'price' => $price,
        ];
    }

    /**
     * @param int $itemId
     * @return bool
     */
    public function removeItem(int $itemId): bool
    {
        unset($_SESSION["shopping_cart"][$itemId]);
        return true;
    }


    /**
     * SUM(ROUND( ROUND(unit_price, 3) x quantity x (1 - (discount/100)), 2)) GROSS_LINES_TOTAL_AFTER_DISCOUNT
     */
    public function cartPrice()
    {
        $total_price = 0;
        if (isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])) {
            foreach ($_SESSION["shopping_cart"] as $item) {
                $total_price = $total_price + number_format($item["qty"] * $item["price"], 2);
            }
        }

        return $total_price;
    }


    /**
     * SUM(ROUND( ROUND(unit_price, 3) x quantity x (1 - (discount/100)), 2)) GROSS_LINES_TOTAL_AFTER_DISCOUNT
     */
    public function cartSubPrice()
    {
        $total_price = 0;
        if (isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])) {
            $cmsApi = new CmsApi();
            foreach ($_SESSION["shopping_cart"] as $item) {
                $product = $cmsApi->getProductById($item['id']);
                $product = $product[key($product)];
                $vat = $cmsApi->getVatById($product['vat']);
                // $total_price = $total_price + (ROUND(ROUND($item["price"], 3) * $item["qty"] * (1 - ($vat[0]['vat_name'] / 100)), 2));
                $total_price = $total_price + (ROUND(ROUND($item["price"], 3) * $item["qty"] , 2));
            }
        }

        return $total_price;
    }
    
    public function cartTotalPrice()
    {
        $total_price = 0;
        if (isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])) {
            $cmsApi = new CmsApi();
            foreach ($_SESSION["shopping_cart"] as $item) {
                $product = $cmsApi->getProductById($item['id']);
                $product = $product[key($product)];
                $vat = $cmsApi->getVatById($product['vat']);
                // $total_price = $total_price + (ROUND(ROUND($item["price"], 3) * $item["qty"] * (1 - ($vat[0]['vat_name'] / 100)), 2));
                $total_price = $total_price + (ROUND(ROUND($item["price"], 3) * $item["qty"] / (1 - ($vat[0]['vat_name'] / 100)), 2));
            }
        }

        return $total_price;
    }

}