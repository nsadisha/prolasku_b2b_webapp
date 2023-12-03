<?php
declare(strict_types=1);

$cmsApi = new \Hlakioui\API\CmsApi();


$cur = $cmsApi->getMainCurrency();
$language = $cmsApi->getMainLang();
$langId = $language['id'];
$trans = new \Hlakioui\Trans\Trans();

?>

<!-- HEADER -->
<header id="header" class="header-area style-01 layout-03">
    <div class="header-top bg-main hidden-xs" style="height: 50px;">
        <div class="container">
            <div class="top-bar left">
                <ul class="horizontal-menu">
                    <li><a href="/"><i class="fa fa-handshake-o" aria-hidden="true"></i><?= $trans->getTrans('B2B') ?></a></li>
                    <li><a href="tel:<?= $trans->getTrans('support_number') ?>"><i class="fa fa-phone" aria-hidden="true"></i><?= $trans->getTrans('support_number') ?></a></li>
                    <li><a href="mailto:<?= $trans->getTrans('support_email'); ?>"><i class="fa fa-envelope" aria-hidden="true"></i><?= $trans->getTrans('support_email'); ?></a></li>
                </ul>
            </div>
            <?php if(isset($_SESSION['user_id'])){ ?>
                <div class="top-bar right">
                    <ul class="horizontal-menu">
                        <li style="text-align:center;"><a href="#" id="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> <?= $trans->getTrans('logout'); ?></a></li>
                    </ul>
                </div>
            <?php } ?>
            <div class="top-bar right">
                <ul class="horizontal-menu">
                    <?php if(isset($_SESSION['user_id'])){ ?>
                    <li class="horz-menu-item currency">
                       <span><?= $cmsApi->getMainCurrency() ?></span>
                    </li>
                    <?php } ?>
                    <li class="horz-menu-item lang">
                        <select id="language"  name="language">
                            <?php foreach ($cmsApi->getLanguages() as $language) {
                                $select = '';
                                if ($langId == $language['id']) {
                                    $select = 'selected';
                                }
                                echo '<option '. $select .' value="' . $language['id'] . '">' . $language['descrip'] . '</option>';
                            }
                            ?>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="header-middle biolife-sticky-object ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-2 col-md-6 col-xs-6">
                    <a href="/" class="biolife-logo"><img src="assets/images/logo.png" alt="logo" width="300" ></a>
                </div>
                <div class="col-lg-6 col-md-7 hidden-sm hidden-xs">
                    <?php if(isset($_SESSION['user_id'])){ ?>
                    <div class="primary-menu">
                        <ul class="menu biolife-menu clone-main-menu clone-primary-menu" id="primary-menu"
                            data-menuname="main menu">
                            <li class="menu-item"><a href="/"><?= $trans->getTrans('Home'); ?></a></li>
                            <li class="menu-item"><a href="products.php"><?= $trans->getTrans('Products List'); ?></a></li>
                            <li class="menu-item"><a href="orders.php"><?= $trans->getTrans('Order History'); ?></a></li>
                            <li class="menu-item"><a href="checkout.php"><?= $trans->getTrans('checkout'); ?></a></li>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-lg-3 col-md-3 col-md-6 col-xs-6">
                    <?php if(isset($_SESSION['user_id'])){ ?>
                    <div class="biolife-cart-info">
                        <div class="minicart-block">
                            <div class="minicart-contain">
                                <a href="javascript:void(0)" class="link-to">
                                            <span class="icon-qty-combine">
                                                <i class="icon-cart-mini biolife-icon"></i>
                                                <span id="total_qty" class="qty">0</span>
                                            </span>
                                    <span class="title"><?= $trans->getTrans('Cart'); ?> </span>
                                    <span id="total_price" class="sub-total">0.00 <?php echo $cur ?></span>
                                </a>
                                <div class="cart-content">
                                    <div class="cart-inner">
                                        <ul id="cart_details" class="products">
                                            <li><?=$trans->getTrans('cart_empty');?></li>
                                        </ul>
                                        <p class="btn-control">
                                            <a href="cart.php" class="btn view-cart"><?= $trans->getTrans('view cart'); ?></a>
                                            <a href="checkout.php" class="btn"><?= $trans->getTrans('checkout'); ?></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</header>