<?php
declare(strict_types=1);

use Hlakioui\API\CmsApi;
use Hlakioui\DotEnv\DotEnv;
use Hlakioui\Shop\Cart;

require_once dirname(__DIR__) . '/vendor/autoload.php';
(new DotEnv(__DIR__ . '/../.env'))->load();
session_start();

$order_id = (int) $_GET['id'] ?? null;
$cmsApi = new \Hlakioui\API\CmsApi();
$language = $cmsApi->getMainLang();
$lang = $language['code'];

if ($order_id) {
    $cmsApi = new CmsApi();
    $cart= new Cart();
    $order = $cmsApi->getOrder($order_id);
    if ($order)
    {

        foreach ($order['order_lines'] as $item) {
            $cart->addItem((int) $item['pid'], (int) $item['quantity'], $item['product_name'][$lang], (float) $item['unit_price']);
        }

        header("Location: cart.php");
        exit;
    }

}
