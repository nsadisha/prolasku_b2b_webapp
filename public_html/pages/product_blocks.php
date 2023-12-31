<?php 
foreach ($products as $product) { ?>
    <div class="col" style="transition: 0.2s;">
        <div class="product-card">
            <?php
                if($product['price'] != $product['price_net_after_discount']){
                    echo '<span class="sale-tag">' . $trans->getTrans("Sale") . '</span>';
                }
            ?>
            
            <a href="single-product.php?id=<?php echo $product['pid'] ?>" class="image-link">
                <?php
                    $product_img = "../assets/images/Image_COMMING_SOON-NEW-PROLASKU-1024.png";
                    
                    // some arrays start with 1
                    if ($product['images'] && $product['images']['0']) {
                        $product_img = $product['images']['0']['URL'];
                    }else if ($product['images'] && $product['images']['1']) {
                        $product_img = $product['images']['1']['URL'];
                    }
                ?>
                <img src="<?= $product_img ?>" alt="Vegetables" class="image">
            </a>
            <hr class="text-secondary" />
            <div class="texts">
                <span class="category">
                    <?php
                        $cat1 = $cmsApi->getCategoryByCid($catList, $product["cid"]);
                        $cat2 = $cmsApi->getCategories([$product["cid"]]);
                        
                        if($cat1 != null){
                            echo $trans->getLang($cat1['category_name'], $lang);
                        }else if(isset($cat2[0])){
                            echo $trans->getLang($cat2[0]['category_name'], $lang);
                        }
                    ?>
                </span>
                <a href="single-product.php?id=<?=$product['pid']?>" class="name" title="<?=$trans->getLang($product['product_name'], $lang) ?>">
                    <?=$trans->getLang($product['product_name'], $lang) ?>
                </a>
                <p class="price">
                    <?=$cur?><?=number_format($product['price_net_after_discount'], 2)?>
                    <?php if($product['price'] != $product['price_net_after_discount']){ ?>
                        <del><?=$cur ?><?=number_format($product['price'], 2) ?></del>
                    <?php } ?>
                </p>
            </div>
            
            <div class="btns mt-3">
                <form action="cart-add-item.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $product['pid'] ?>">
                    <input type="hidden" name="name" value="<?=$trans->getLang($product['product_name'], $lang) ?>">
                    <input type="hidden" name="qty" value="1">
                    <input type="hidden" name="price" value="<?php echo $product['price_net_after_discount'] ?>">
                    <?= $cmsApi->populateCartStockInputs($product); ?>

                    <input type="hidden" name="__token" value="add_<?php echo $product['pid'] ?>">
                    <div class="buttons d-flex">
                        <a href="#" class="btn add-to-cart-btn add_to_cart mx-auto">
                            <?=$trans->getTrans("add to cart")?>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
} ?>