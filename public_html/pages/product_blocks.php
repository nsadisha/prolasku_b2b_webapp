<?php 
foreach ($products as $product) {
    ?>
    <div class="product-item col-md-4">
        <div class="contain-product layout-default">
            <div class="product-thumb">
                <a href="single-product.php?id=<?php echo $product['pid'] ?>"
                   class="link-to-product">
                    <?php
                    if ($product['images'] && $product['images']['0']) {
                        ?>
                        <img src="<?php echo $product['images']['0']['URL'] ?>"
                             alt="Vegetables"
                             width="270"
                             height="270" class="product-thumnail">
                        <?php
                    } else {
                        ?>
                        <img src="../assets/images/Image_COMMING_SOON-NEW-PROLASKU-1024.png" alt="Vegetables"
                             width="270"
                             height="270" class="product-thumnail">
                        <?php
                    }
                    ?>
                </a>
            </div>
            <div class="info">
                <h4 class="product-title">
                    <a href="single-product.php?id=<?php echo $product['pid'] ?>"
                       class="pr-name">
                        <?=$trans->getLang($product['product_name'], $lang) ?>
                    </a>
                </h4>
                <a href="shop.php?cid=<?=$product['cid']?>"
                   class="pr-name">
                    
                </a>
                <div class="price ">
                    <ins>
                        <span class="price-amount">
                            <span class="currencySymbol"><?php echo $cur ?></span>
                            <?php echo number_format($product['price_net_after_discount'], 2) ?>
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
                <div class="slide-down-box">
                    <form action="cart-add-item.php" method="post">
                        <input type="hidden" name="id"
                               value="<?php echo $product['pid'] ?>">
                        <input type="hidden" name="name"
                               value="<?=$trans->getLang($product['product_name'], $lang) ?>">
                        <input type="hidden" name="qty" value="1">
                        <input type="hidden" name="price"
                               value="<?php echo $product['price_net_after_discount'] ?>">
                        <?php
                            echo $cmsApi->populateCartStockInputs($product);
                        ?>

                        <input type="hidden" name="__token"
                               value="add_<?php echo $product['pid'] ?>">
                        <div class="buttons">
                            <a href="#" class="btn add-to-cart-btn add_to_cart">
                                <?=$trans->getTrans("add to cart")?>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
