<?php
declare(strict_types=1);

use Hlakioui\API\CmsApi;

$cmsApi = new CmsApi();
$cur = $cmsApi->getMainCurrency();
$language = $cmsApi->getMainLang();
$lang = $language['code'];
$trans = new \Hlakioui\Trans\Trans();

$categories = $cmsApi->getCategories();

?>
<div id="main-content" class="main-content">
    <!--Products Block: Product Tab-->
    <div class="sm-margin-top-193px xs-margin-top-30px">
        <div class="container">
            <div class="biolife-title-box">
                <h3 class="main-title pull-left"><?= $trans->getTrans('Categories:'); ?></h3>
            </div>
            <div class="biolife-tab biolife-tab-contain sm-margin-top-34px">
                    <div class="row">
                        <!-- Main content -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <ul class="category-ul">
                                <?php
                                foreach ($categories as $category) {
                                    $_category_name = isset($category['category_name']) ? $trans->getLang($category['category_name'], $lang) : '';
                                    if(empty($_category_name)) {continue;}
                                    ?>
                                    <?php /*
                                    <div class="category-item col-md-2">
                                        <div class="contain-category layout-default">
                                            <div class="category-thumb">
                                                <a href="single-category.php?id=<?php echo $category['cid'] ?>"
                                                   class="link-to-category">
                                                    <?php
                                                    if ($category['images'] && $category['images']['0']) {
                                                        ?>
                                                        <img src="<?php echo $category['images']['0']['URL'] ?>"
                                                             alt="Vegetables"
                                                             width="270"
                                                             height="270" class="category-thumnail">
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <img src="../assets/images/Image_COMMING_SOON-NEW-PROLASKU-1024.png" alt="Vegetables"
                                                             width="270"
                                                             height="270" class="category-thumnail">
                                                        <?php
                                                    }
                                                    ?>
                                                </a>
                                            </div>
                                            <div class="info">
                                                <h4 class="category-title">
                                                    <a href="products.php?cid=<?php echo $category['cid'] ?>"
                                                       class="pr-name">
                                                        <?=isset($category['category_name']) ? $trans->getLang($category['category_name'], $lang) : '' ?>
                                                    </a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <?php */ ?>
                                    <li class="" style="">
                                        <div class="contain-category layout-default">
                                            <div class="category-thumb">
                                                <a href="single-category.php?id=<?php echo $category['cid'] ?>"
                                                   class="link-to-category">
                                                </a>
                                            </div>
                                            <a href="products.php?cid=<?php echo $category['cid'] ?>"
                                               class="pr-name">
                                                <?=$_category_name?>
                                            </a>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>