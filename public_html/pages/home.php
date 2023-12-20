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


<!--Hero Section-->
<div class="hero-section categories-hero-bg" style="margin: 0;">
    <h1 class="page-title"><?= $trans->getTrans('Categories') ?></h1>
</div>

<div id="main-content" class="main-content">
    <!--Products Block: Product Tab-->
    <div>
        <div class="container">
            <div class="biolife-tab biolife-tab-contain py-5">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 gy-5">
                        <div class="col">
                            <a class="category-card" href="products.php?cid=117">
                                <div class="img-wrapper">
                                    <div class="rdb"></div>
                                    <img class="img" src="../assets/images/category-1.png" alt="category image">
                                </div>
                                <h4 class="name">Category 1</h4>
                            </a>
                        </div>
                        <div class="col">
                            <a class="category-card" href="products.php?cid=117">
                                <div class="img-wrapper">
                                    <div class="rdb"></div>
                                    <img class="img" src="../assets/images/category-2.png" alt="category image">
                                </div>
                                <h4 class="name">Category 2</h4>
                            </a>
                        </div>
                        <div class="col">
                            <a class="category-card" href="products.php?cid=117">
                                <div class="img-wrapper">
                                    <div class="rdb"></div>
                                    <img class="img" src="../assets/images/category-3.png" alt="category image">
                                </div>
                                <h4 class="name">Category 3</h4>
                            </a>
                        </div>
                        <div class="col">
                            <a class="category-card" href="products.php?cid=117">
                                <div class="img-wrapper">
                                    <div class="rdb"></div>
                                    <img class="img" src="../assets/images/category-4.png" alt="category image">
                                </div>
                                <h4 class="name">Category 4</h4>
                            </a>
                        </div>
                        <div class="col">
                            <a class="category-card" href="products.php?cid=117">
                                <div class="img-wrapper">
                                    <div class="rdb"></div>
                                    <img class="img" src="../assets/images/category-5.png" alt="category image">
                                </div>
                                <h4 class="name">Category 5</h4>
                            </a>
                        </div>
                        <div class="col">
                            <a class="category-card" href="products.php?cid=117">
                                <div class="img-wrapper">
                                    <div class="rdb"></div>
                                    <img class="img" src="../assets/images/category-6.png" alt="category image">
                                </div>
                                <h4 class="name">Category 6</h4>
                            </a>
                        </div>

                        <!-- Main content -->
                        <?php foreach($categories as $category) {
                            $_category_name = isset($category['category_name']) ? $trans->getLang($category['category_name'], $lang) : '';
                            if(empty($_category_name)) {continue;}
                            $_category_img = isset($category["image"]) && $category["image"] != "" ? $category["image"] : '../assets/images/Image_COMMING_SOON-NEW-PROLASKU-1024.png';
                            $_cid = $category['cid'];
                            ?>

                            <div class="col">
                                <a class="category-card" href="products.php?cid=<?=$_cid?>">
                                    <div class="img-wrapper">
                                        <div class="rdb"></div>
                                        <img class="img" src="<?=$_category_img?>" alt="category image">
                                    </div>
                                    <h4 class="name"><?=$_category_name?></h4>
                                </a>
                            </div>

                        <?php } ?>
                        
                        
                        <?php /*<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 d-none">
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
                        </div> */ ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>