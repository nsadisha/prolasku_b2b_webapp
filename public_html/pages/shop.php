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

<!--Hero Section-->
<div class="hero-section categories-hero-bg" style="margin: 0;">
    <h1 class="page-title"><?= $trans->getTrans('Products List'); ?></h1>
</div>

<div class="container py-3 py-md-4 bg-white" style="border-bottom: solid 1px #aaaaaa;">
    <div class="row align-items-center gy-3">
        <div class="col-auto">Showing results of <?= sizeof($products); ?> </div>
        <div class="col"></div>
        <div class="col-auto">
            <!-- <div class="tile-btns layout">
                <button id="layout-4-btn" class="active"><?= four_tiles(); ?></button>
                <button id="layout-6-btn"><?= six_tiles(); ?></button>
            </div> -->
        </div>
        <div class="col-auto d-none d-xl-block">
            <div class="tile-btns tile">
                <button id="tiles-4-btn"><?= four_tiles(); ?></button>
                <button id="tiles-9-btn"><?= nine_tiles(); ?></button>
                <button id="tiles-16-btn" class="active"><?= sixteen_tiles(); ?></button>
            </div>
        </div>
        <div class="col-auto d-block d-lg-none">
            <button class="btn" id="mobile-filter-toggle" data-object="open-mobile-filter">
                <i class="fa fa-filter" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</div>

<div id="main-content" class="main-content" style="z-index: 101;">
    <!--Products Block: Product Tab-->
    <div class="product-tab xs-margin-top-30px mt-3">
        <div class="container">
            <div class="biolife-tab biolife-tab-contain sm-margin-top-34px">
                <div class="tab-content">
                    <div class="row">
                        <!-- Sidebar -->
                        <aside id="sidebar" class="sidebar col-lg-3 col-md-4 col-sm-12 col-xs-12">
                            <div class="biolife-mobile-panels">
                                <span class="biolife-current-panel-title"><?= $trans->getTrans('Sidebar'); ?></span>
                                <a class="biolife-close-btn" href="#" data-object="open-mobile-filter" style="text-decoration: none;">&times;</a>
                            </div>
                            <div class="sidebar-contain">
                                <form id="filter-form">
                                    <div class="widget biolife-filter">
                                        <div class="wgt-content">
                                            <!-- <label class="wgt-title form-label" for="search"><?= $trans->getTrans('Product Search:');  ?></label> -->
                                            <input class="product-search form-control" type="text" 
                                            name="search" id="search" placeholder="<?=$trans->getTrans('Product Search:');?>">
                                        </div>
                                    </div>
                                    <div class="widget biolife-filter ">
                                        <h4 class="wgt-title"><?= $trans->getTrans('Categories:'); ?> </h4>
                                        <div class="wgt-content cat_scrollbar categories" style="max-height: 340px;overflow-y: scroll;margin: 15px 0; padding-left: 1rem;">
                                            <?php foreach ($categories as $category) {
                                                    if (isset($category['category_name'])) {
                                                        ?>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="categories" value="<?= $category['cid'] ?>" id="cid-<?= $category['cid'] ?>" 
                                                                    <?=isset($_GET['cid'])&&$_GET['cid']==$category['cid']?'checked':''?>>
                                                                <label class="form-check-label" for="cid-<?= $category['cid'] ?>">
                                                                    <?=$trans->getLang($category['category_name'], $lang) ?>
                                                                </label>
                                                            </div>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="widget biolife-filter scrollbar pb-0">
                                        <h4 class="wgt-title"><?= $trans->getTrans('Brands:'); ?> </h4>
                                        <div class="wgt-content brand_scrollbar brands" style="max-height: 340px;overflow-y: scroll;margin: 15px 0; padding-left: 1rem;">
                                            <?php foreach ($brands as $brand) {
                                                if (isset($brand['brand_name'])) {
                                                    ?>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="brands" value="<?= $brand['bid'] ?>" id="bid-<?= $brand['bid'] ?>" 
                                                                <?=isset($_GET['bid'])&&$_GET['bid']==$brand['bid']?'checked':''?>>
                                                            <label class="form-check-label" for="bid-<?= $brand['bid'] ?>">
                                                                <?=$trans->getLang($brand['brand_name'], $lang) ?>
                                                            </label>
                                                        </div>
                                                    <?php
                                                }
                                            } ?>
                                        </div>
                                    </div>
                                </form>
                                <div class="widget biolife-filter">
                                    <button class="btn btn-primary btn-bold w-100 filter"><?= $trans->getTrans('Filter'); ?></button>
                                </div>
                            </div>
                        </aside>
                        <!-- Main content -->
                        <div id="main-content" class="main-content col-lg-9 col-md-12 col-sm-12 col-xs-12">
                            <div class="row products-list row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 gy-3">
                                <?php include('pages/product_blocks.php'); ?>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="offset-lg-3 col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <div class="pagination__next" style="text-align: center;margin: 35px 0;">
                            <button id="product-load-more" class="btn btn-submit btn-bold px-4"><?= $trans->getTrans('Load More'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

    function four_tiles(){
        return "<div class='tiles-4'><div></div><div></div><div></div><div></div></div>";
    }

    function six_tiles(){
        return "<div class='tiles-6'><div></div><div></div><div></div><div></div><div></div><div></div></div>";
    }

    function nine_tiles(){
        return "<div class='tiles-9'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>";
    }

    function sixteen_tiles(){
        return "<div class='tiles-16'><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>";
    }

?>