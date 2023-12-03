<?php
declare(strict_types=1);

$cmsApi = new \Hlakioui\API\CmsApi();
$cur = $cmsApi->getMainCurrency();
$cids = isset($_GET['cid']) ? array((int)$_GET['cid']) : [];
$products = $cmsApi->getProducts(["cid"=>$cids]);
$categories = $cmsApi->getCategories();
$brands = $cmsApi->getBrands();
$trans = new \Hlakioui\Trans\Trans();

?>
<div id="main-content" class="main-content">
    <!--Products Block: Product Tab-->
    <div class="product-tab z-index-20 sm-margin-top-193px xs-margin-top-30px">
        <div class="container">
            <div class="biolife-title-box">
                <span class="subtitle"></span>
                <h3 class="main-title"><?= $trans->getTrans('Products List'); ?></h3>
            </div>
            <div class="biolife-tab biolife-tab-contain sm-margin-top-34px">
                <div class="tab-content">
                    <div class="row">
                        <!-- Sidebar -->
                        <aside id="sidebar" class="sidebar col-lg-3 col-md-4 col-sm-12 col-xs-12">
                            <div class="biolife-mobile-panels">
                                <span class="biolife-current-panel-title"><?= $trans->getTrans('Sidebar'); ?></span>
                                <a class="biolife-close-btn" href="#" data-object="open-mobile-filter">&times;</a>
                            </div>
                            <div class="sidebar-contain">
                                <div class="widget biolife-filter">
                                    <div class="wgt-content">
                                        <label class="wgt-title form-label" for="search"><?= $trans->getTrans('Product Search:');  ?></label>
                                        <input class="product-search form-control" type="text" name="search" id="search">
                                    </div>
                                </div>
                                <div class="widget biolife-filter ">
                                    <h4 class="wgt-title"><?= $trans->getTrans('Categories:'); ?> </h4>
                                    <div class="wgt-content cat_scrollbar"
                                         style="max-height: 340px;overflow-y: scroll;margin: 15px 0;">
                                        <ul class="categories check-list multiple">
                                            <?php foreach ($categories as $category) {
                                                if (isset($category['category_name'])) {
                                                    ?>
                                                    <li class="check-list-item <?=isset($_GET['cid'])&&$_GET['cid']==$category['cid']?'selected':''?>"
                                                        data-id="<?php echo $category['cid'] ?>">
                                                        <a href="#"
                                                           class="check-link"><?=$trans->getLang($category['category_name'], $lang) ?></a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="widget biolife-filter scrollbar">
                                    <h4 class="wgt-title"><?= $trans->getTrans('Brands:'); ?> </h4>
                                    <div class="wgt-content brand_scrollbar"
                                         style="max-height: 340px;overflow-y: scroll;margin: 15px 0;">
                                        <ul class="brands check-list multiple">
                                            <?php foreach ($brands as $brand) {
                                                if (isset($brand['brand_name'])) {
                                                    ?>
                                                    <li class="check-list-item"
                                                        data-id="<?php echo $brand['bid'] ?>">
                                                        <a href="#"
                                                           class="check-link"><?=$trans->getLang($brand['brand_name'], $lang) ?></a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="widget biolife-filter">
                                    <button class="btn btn-primary filter"><?= $trans->getTrans('Filter'); ?></button>
                                </div>
                            </div>
                        </aside>
                        <!-- Main content -->
                        <div id="main-content" class="main-content col-lg-9 col-md-8 col-sm-12 col-xs-12">
                            <div class="row products-list nav-center-02 nav-none-on-mobile eq-height-contain">
                                <?php 
                                include('pages/product_blocks.php');
                                ?>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="offset-lg-3 offset-md-4 col-lg-9 col-md-8 col-sm-12 col-xs-12">
                        <div class="pagination__next" style="text-align: center;margin: 35px 0;">
                            <button id="product-load-more" class="btn btn-primary pagination__next"><?= $trans->getTrans('Load More'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
