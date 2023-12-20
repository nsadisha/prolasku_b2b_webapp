<?php
declare(strict_types=1);

use Hlakioui\API\CmsApi;

$cmsApi = new CmsApi();
$cur = $cmsApi->getMainCurrency();
$language = $cmsApi->getMainLang();
$lang = $language['code'];
$trans = new \Hlakioui\Trans\Trans();

// $cmsApi->pr($order, 1);
?>
<!--Navigation section-->
<div class="container">
    <nav class="biolife-nav">
        <ul>
            <li class="nav-item"><a href="/" class="permal-link"><?= $trans->getTrans('Home') ?></a></li>
            <li class="nav-item"><span class="current-page"><?= $trans->getTrans('Order History') ?></span></li>
        </ul>
    </nav>
</div>

<div class="page-contain shopping-cart">
    <!-- Main content -->
    <div id="main-content" class="main-content">
        <div class="container">
            <!--Cart Table-->
            <div class="shopping-cart-container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <h3 class="box-title"><?= $trans->getTrans('Your order details') ?></h3>
                        <p><?php echo $order['payer_details'] ?></p>
                        <form class="shopping-cart-form" action="#" method="post">
                            <table class="shop_table cart-form">
                                <thead>
                                <tr>
                                    <th class="product-name"><?= $trans->getTrans('Product Name') ?></th>
                                    <th class="product-price"><?= $trans->getTrans('Price') ?></th>
                                    <th class="product-quantity"><?= $trans->getTrans('Quantity') ?></th>
                                    <th class="product-subtotal"><?= $trans->getTrans('Total') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $total_price = 0;
                                $total_item = 0;
                                foreach ($order['order_lines'] as $item) {
                                    $product = $cmsApi->getProductById($item['pid']);
                                    $product = $product[0];
                                    ?>
                                    <tr class="cart_item">
                                        <td class="product-thumbnail" data-title="Product Name">
                                            <a class="prd-thumb" href="single-product.php?id=<?php echo $product['pid'] ?>">
                                                <figure>
                                                    <?php
                                                    if ($product['images'] && $product['images']['0']) {
                                                        ?>
                                                        <img src="<?php echo $product['images']['0']['URL'] ?>"
                                                             alt="Vegetables"
                                                             width="113"
                                                             height="113" class="product-thumnail">
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <img src="../assets/images/Image_COMMING_SOON-NEW-PROLASKU-1024.png" alt="Vegetables"
                                                             width="113"
                                                             height="113" class="product-thumnail">
                                                        <?php
                                                    }
                                                    ?>                                                    </figure>
                                            </a>
                                            <a class="prd-name"
                                               href="single-product.php?id=<?php echo $product['pid'] ?>"> <?php echo $item['product_name'][$lang] ?></a>
                                        </td>
                                        <td class="product-price d-none d-md-table-cell" data-title="Price">
                                            <div class="price price-contain">
                                                <ins><span class="price-amount">
                                                            <?php echo $item["unit_price"] ?>
                                                        <span class="currencySymbol"> <?= $cur?></span>
                                                    </span>
                                                </ins>
                                            </div>
                                        </td>
                                        <td class="product-quantity d-none d-md-table-cell" data-title="Quantity">
                                            <span class="price-amount">
                                                <?php echo $item["quantity"] ?>
                                            </span>
                                        </td>
                                        <td class="product-subtotal d-none d-md-table-cell" data-title="Total">
                                            <div class="price price-contain">
                                                <ins><span class="price-amount"><span
                                                                class="currencySymbol"></span><?php echo($item["quantity"] * $item["unit_price"]) ?> <?= $cur?></span>
                                                </ins>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mobile-quantity d-block d-md-none">
                                                <strong class=""><?=$item["unit_price"];?></strong>
                                                &times; <?php echo $item["quantity"] ?>
                                                <strong class="ms-3"><?php echo($item["quantity"] * $item["unit_price"]) ?> <?= $cur?></strong>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $total_item = $total_item + 1;
                                }
                                ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="shpcart-subtotal-block">
                            <div class="subtotal-line">
                                <b class="stt-name"><?= $trans->getTrans('Total') ?> <span class="sub">(<?php echo $total_item ?>><?= $trans->getTrans('items') ?>)</span></b>
                                <span class="stt-price"><?php echo number_format($order['total'], 2) ?> <?= $cur?></span>
                            </div>
                            <div class="subtotal-line">
                                <b class="stt-name"><?= $trans->getTrans('Subtotal') ?><span class="sub"></span></b>
                                <span class="stt-price"><?php echo number_format($order['total_vat_data'][0]['base'], 2) ?> <?= $cur?></span>
                            </div>
                            <div class="subtotal-line">
                                <b class="stt-name"><?= $trans->getTrans('VAT') ?><span class="sub"></span></b>
                                <span class="stt-price"><?php echo number_format($order['total_vat_data'][0]['amount'], 2) ?> <?= $cur?></span>
                            </div>
                            <div class="btn-checkout">
                                <a href="reorder.php?id=<?php echo $order['id'] ?>" class="btn checkout"><?= $trans->getTrans('Order again') ?></a>
                            </div>
                            <div class="btn-checkout">
                                <a target="_blank" href="https://easycms.fi/order.php?ref=<?=$order['link_id']?>&id=<?=getenv('CMS_API_ACCOUNT_ID')?>" class="btn btn-info"><i class="fa fa-file-pdf-o" style="margin-right:13px"></i> <?= $trans->getTrans('Download PDF') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
