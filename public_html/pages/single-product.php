<?php
$cur = $cmsApi->getMainCurrency();
$language = $cmsApi->getMainLang();
$lang = $language['code'];
$trans = new \Hlakioui\Trans\Trans();
?>
<!--Hero Section-->
<div class="hero-section hero-background" style="margin: 0;">
    <h1 class="page-title"><?php echo $product['product_name'][$lang] ?></h1>
</div>
<!--Navigation section-->
<div class="container">
    <nav class="biolife-nav">
        <ul>
            <li class="nav-item"><a href="/" class="permal-link"><?= $trans->getTrans('Home') ?></a></li>
            <li class="nav-item"><span class="current-page"><?php echo $trans->getLang($product['product_name'], $lang) ?></span></li>
        </ul>
    </nav>
</div>

<div class="page-contain single-product">
    <div class="container">

        <!-- Main content -->
        <div id="main-content" class="main-content">

            <!-- summary info -->
            <div class="sumary-product single-layout">
                <div class="media">
                    <ul class="biolife-carousel slider-for"
                        data-slick='{"arrows":false,"dots":false,"slidesMargin":30,"slidesToShow":1,"slidesToScroll":1,"fade":true,"asNavFor":".slider-nav"}'>
                        <?php
                        if ($product['images']) {
                            foreach ($product['images'] as $image) {
                                ?>
                                <li><img src="<?php echo $image['URL'] ?>" alt="" width="500" height="500"></li>
                                <?php
                            }
                        } else {
                            ?>
                            <li><img src="../assets/images/Image_COMMING_SOON-NEW-PROLASKU-1024.png" alt="" width="500" height="500"></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <ul class="biolife-carousel slider-nav"
                        data-slick='{"arrows":false,"dots":false,"centerMode":false,"focusOnSelect":true,"slidesMargin":10,"slidesToShow":4,"slidesToScroll":1,"asNavFor":".slider-for"}'>
                        <?php
                        if ($product['images']) {
                            foreach ($product['images'] as $image) {
                                ?>
                                <li><img src="<?php echo $image['URL'] ?>" alt="" wwidth="88" height="88"></li>
                                <?php
                            }
                        } else {
                            ?>
                            <li><img src="../assets/images/Image_COMMING_SOON-NEW-PROLASKU-1024.png" alt="" wwidth="88" height="88"></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="product-attribute">
                    <h3 class="title"><?php echo $trans->getLang($product['product_name'], $lang) ?></h3>
                    <?=$cmsApi->populateProductStock($product);?></span>

                    <div class="price">
                        <ins>
                            <span class="price-amount">
                                <span class="currencySymbol"><?php echo $cur ?></span>
                                <?php echo number_format($product['price_net_after_discount'], 2) ?>
                                <?='<span style="font-size:70%"> /'.$cmsApi->get_stock_location_name($product['stock_type_id']).'</span>';?>
                            </span>
                        </ins>
                        <?php if($product['price'] != $product['price_net_after_discount']){ ?>
                            <del>
                                <span class="price-amount">
                                    <span class="currencySymbol"><?php echo $cur ?></span>
                                    <?php echo number_format($product['price'], 2) ?>
                                </span>
                            </del>
                        <?php } ?>

                    </div>
                    
                    <p class="excerpt">
                        <?php if (isset($product['product_desc'][$lang])) {
                            echo '<div class="bold m-t-sm p-t-sm">'.$trans->getTrans('product_desc').':</div>';
                            echo $product['product_desc'][$lang];
                        } ?>
                    </p>
                </div>
                <form class="action-form" action="cart-add-item.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $product['pid'] ?>">
                    <input type="hidden" name="name" value="<?php echo $trans->getLang($product['product_name'], $lang) ?>">
                    <input type="hidden" name="price" value="<?php echo $product['price_net_after_discount'] ?>">
                    <?php
                        echo $cmsApi->populateCartStockInputs($product);
                    ?>
                    <input type="hidden" name="__token" value="add_<?php echo $product['pid'] ?>">
                    <div class="quantity-box">
                        <span class="title"><?= $trans->getTrans('Quantity:') ?></span>
                        <div class="qty-input">
                            <input type="text" name="qty" value="1" data-max_value="2000" data-min_value="1"
                                   data-step="1">
                            <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                            <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="buttons">
                        <a href="#" class="btn add-to-cart-btn add_to_cart"><?= $trans->getTrans('add to cart') ?></a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>