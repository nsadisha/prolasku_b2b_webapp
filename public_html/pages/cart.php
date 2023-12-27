<?php
declare(strict_types=1);

$trans = new \Hlakioui\Trans\Trans();

?>

<!--Hero Section-->
<div class="hero-section categories-hero-bg" style="margin: 0;">
    <h1 class="page-title"><?= $trans->getTrans('Cart') ?></h1>
</div>

<!--Navigation section-->
<div class="container">
    <nav class="biolife-nav">
        <ul>
            <li class="nav-item"><a href="/" class="permal-link"> <?= $trans->getTrans('Home'); ?></a></li>
            <li class="nav-item"><span class="current-page"><?= $trans->getTrans('Order History'); ?></span></li>
        </ul>
    </nav>
</div>

<div class="page-contain shopping-cart py-5 pt-3">

    <!-- Main content -->
    <div id="main-content" class="main-content">
        <div class="container">

            <!--Cart Table-->
            <div class="shopping-cart-container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <h3 class="box-title"><?= $trans->getTrans('Your cart items'); ?></h3>
                        <?php
                        $total_price = 0;
                        $total_item = 0;
                        if (!empty($_SESSION["shopping_cart"])) { ?>
                            <form class="shopping-cart-form" action="cart-add-item.php" method="post">
                                <table class="shop_table cart-form">
                                    <thead>
                                    <tr>
                                        <th class="product-name"><?= $trans->getTrans('Product Name'); ?></th>
                                        <th class="product-price"><?= $trans->getTrans('Price'); ?></th>
                                        <th class="product-quantity"><?= $trans->getTrans('Quantity'); ?></th>
                                        <th class="product-subtotal"><?= $trans->getTrans('Total'); ?></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // $cmsApi->pr($_SESSION["shopping_cart"]);
                                    foreach ($_SESSION["shopping_cart"] as $item) {
                                        $product = $cmsApi->getProductById($item['id']);
                                        $product = $product[key($product)];
                                        ?>
                                        <tr class="cart_item">
                                            <td class="product-thumbnail" data-title="Product Name">
                                                <div class="row column-gap-3">
                                                    <div class="col-md-3">
                                                        <a class="prd-thumb" href="single-product.php?id=<?php echo $product['pid'] ?>">
                                                            <?php
                                                            if ($product['images'] && $product['images']['0']) {
                                                                ?>
                                                                <img src="<?php echo $product['images']['0']['URL'] ?>"
                                                                        alt="Vegetables" class="product-thumnail">
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="../assets/images/Image_COMMING_SOON-NEW-PROLASKU-1024.png" alt="Vegetables"
                                                                        width="100"
                                                                        height="100" class="product-thumnail">
                                                                <?php
                                                            }
                                                            ?>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <a class="prd-name"
                                                        href="single-product.php?id=<?php echo $product['pid'] ?>"> <?php echo $product['product_name'][$lang] ?></a>
                                                        <div class="action">
                                                            <a data-id="<?php echo $product['pid'] ?>" class="remove">
                                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="product-price" data-title="Price">
                                                <div class="price price-contain">
                                                    <ins><span class="price-amount">
                                                            <?php echo number_format($product['price_net_after_discount'], 2) ?>
                                                            <span class="currencySymbol"><?= $cur ?></span>
                                                        </span>
                                                    </ins>
                                                    <?php if($product['price'] != $product['price_net_after_discount']){ ?>
                                                        <del>
                                                            <span class="price-amount">
                                                                <?php echo number_format($product['price'], 2) ?>
                                                                <span class="currencySymbol"><?php echo $cur ?></span>
                                                            </span>
                                                        </del>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td class="product-quantity" data-title="Quantity">
                                                <div class="quantity-box type1 d-flex">
                                                    <div class="year-selector mx-auto quantity-selector">
                                                        <a href="#" class="qty-btn btn-up" id="pd-q-down">
                                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                                        </a>
                                                        <input type="number" id="pd-quantity-<?=$product['pid'];?>" class="input-element qty" name="qty-<?=$product['pid'];?>" 
                                                            value="<?=$item['qty']?>" min="1" max="2000" data-max_value="2000" data-min_value="1" data-step="1">
                                                        <a href="#" class="qty-btn btn-down" id="pd-q-up">
                                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                    <!-- <div class="qty-input">
                                                        <input class="qty" type="text"
                                                               name="qty-<?php echo $product['pid'];?>"
                                                        value="<?php echo $item['qty'] ?>" data-max_value="20"
                                                        data-min_value="1" data-step="1">
                                                        <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up"
                                                                                              aria-hidden="true"></i></a>
                                                        <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down"
                                                                                                aria-hidden="true"></i></a>
                                                    </div> -->
                                                </div>
                                            </td>
                                            <td class="product-subtotal" data-title="Total">
                                                <div class="price price-contain">
                                                    <ins><span class="price-amount">
                                                            <?php echo number_format($item["qty"] * $product['price_net_after_discount'], 2) ?>
                                                            <span class="currencySymbol"><?= $cur ?></span>
                                                        </span>
                                                    </ins>
                                                    <?php if($product['price'] != $product['price_net_after_discount']){ ?>
                                                        <del>
                                                            <span class="price-amount">
                                                                <?php echo number_format($item["qty"] * $product['price'], 2) ?>
                                                                <span class="currencySymbol"><?php echo $cur ?></span>
                                                            </span>
                                                        </del>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td class="product-subtotal" data-title="Total">
                                                <button data-id="<?php echo $product['pid'] ?>"
                                                        class="update-item btn btn-primary btn-bold"><?= $trans->getTrans('update'); ?>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                        $total_item = $total_item + 1;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </form>
                        <?php } else {
                            echo $trans->getTrans('cart_empty'); //echo 'Your Cart is Empty! ';
                        } ?>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="shpcart-subtotal-block">
                            <div class="subtotal-line">
                                <b class="stt-name"><?= $trans->getTrans('Total'); ?> <span class="sub">(<?php echo $total_item ?>*<?= $trans->getTrans('items'); ?>)</span></b>
                                <span class="stt-price"><?php echo $cart->cartPrice() ?> <?= $cur?></span>
                            </div>
                            <?php /*
                            <div class="subtotal-line">
                                <b class="stt-name"><?= $trans->getTrans('Subtotal'); ?><span class="sub"></span></b>
                                <span class="stt-price"><?php echo $cart->cartSubPrice() ?> <?= $cur?></span>
                            </div>
                            */?>
                            <div class="subtotal-line">
                                <b class="stt-name"><?= $trans->getTrans('VAT'); ?><span class="sub"></span></b>
                                <span class="stt-price"><?php echo  ($cart->cartSubPrice() - $cart->cartPrice()) ?> <?= $cur?></span>
                            </div>
                            <div class="btn-checkout">
                                <a href="checkout.php" class="btn checkout"><?= $trans->getTrans('checkout'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
