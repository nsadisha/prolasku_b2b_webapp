<?php
declare(strict_types=1);

use Hlakioui\DotEnv\DotEnv;

require_once dirname(__DIR__) . '/vendor/autoload.php';
(new DotEnv(__DIR__ . '/../.env'))->load();


session_start();
$cmsApi = new \Hlakioui\API\CmsApi();
$total_price = 0;
$total_item = 0;

$trans = new \Hlakioui\Trans\Trans();

$cur = $cmsApi->getMainCurrency();
$language = $cmsApi->getMainLang();
$lang = $language['code'];
$output = '';
if (!empty($_SESSION["shopping_cart"])) {
    $img = '<img src="../assets/images/Image_COMMING_SOON-NEW-PROLASKU-1024.png" alt="Vegetables" width="90" height="90" class="product-thumbnail">';
    foreach ($_SESSION["shopping_cart"] as $item) {
        $product = $cmsApi->getProductById($item['id']);
        $product = $product[0];
        if ($product['images'] && $product['images']['0']) {
            $img = ' <img src="'. $product['images']['0']['URL'] .'" alt="Vegetables" width="90" height="90" class="product-thumbnail">';
        } else {
            $img = '<img src="../assets/images/Image_COMMING_SOON-NEW-PROLASKU-1024.png" alt="Vegetables" width="90" height="90" class="product-thumbnail">';
        }
        $output .= '<li>
                        <div class="minicart-item">
                            <div class="thumb">
                                <a href="single-product.php?id=' . $item['id'] . '">
                                 '. $img .'
                            </div>
                            <div class="left-info">
                                <div class="product-title"><a href="single-product.php?id=' . $item['id'] . '" class="product-name">' . $item['name'] . '</a></div>
                                <div class="price">
                                    <ins><span class="price-amount"><span class="currencySymbol">'. $cur  .'</span>' .number_format($item['price'], 2)  . '</span></ins>
                                </div>
                                <div class="qty">
                                    <label for="cart[id123][qty]">Qty:</label>
                                    <input type="number" class="input-qty" value="' . $item['qty'] . '" disabled>
                                </div>
                            </div>
                            <div class="action">
                                <a data-id="' . $item['id'] . '" class="remove"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </li>';
        $total_price = $total_price + ($item["qty"] * $item["price"]);
        $total_item = $total_item + 1;
    }
} else {
    $output .= '<li><div class="minicart-item"><div class="left-info"><div class="product-title">'.$trans->getTrans('cart_empty').'</div></div></div></li>';
}
$data = array(
    'cart_details' => $output,
    'total_price' => number_format($total_price, 2) .' '. $cur,
    'total_item' => $total_item
);

echo json_encode($data);