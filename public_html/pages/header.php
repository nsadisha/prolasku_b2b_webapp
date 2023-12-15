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
    <div class="header-top bg-main py-1">
        <div class="container">
            <div class="row align-items-center ms-0">
                <div class="col-auto">
                    <a href="/">
                        <i class="fa fa-handshake-o" aria-hidden="true"></i>
                        <span class="d-none d-sm-inline"><?= $trans->getTrans('B2B') ?></span>
                    </a>
                </div>
                <div class="col-auto h-100 d-none d-md-block"><div class="vr"></div></div>
                <div class="col-auto">
                    <a href="tel:<?= $trans->getTrans('support_number') ?>">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <span class="d-none d-lg-inline"><?= $trans->getTrans('support_number') ?></span>
                    </a>
                </div>
                <div class="col-auto h-100 d-none d-md-block"><div class="vr"></div></div>
                <div class="col-auto">
                    <a href="mailto:<?= $trans->getTrans('support_email'); ?>">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span class="d-none d-lg-inline"><?= $trans->getTrans('support_email'); ?></span>
                    </a>
                </div>

                <div class="col"></div>

                <div class="col-auto">
                    <a href="#"><?= $cmsApi->getMainCurrency() ?></a>
                </div>
                <div class="col-auto h-100 d-none d-md-block"><div class="vr"></div></div>
                <div class="col-auto">
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
                </div>
                <div class="col-auto h-100 d-none d-md-block"><div class="vr"></div></div>
                <div class="col-auto">
                    <?php if(isset($_SESSION['user_id'])){ ?>
                        <a href="#" id="logout">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            <span class="d-none d-sm-inline"><?= $trans->getTrans('logout'); ?></span>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="header-middle biolife-sticky-object">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container py-2 py-md-3">
                <a class="navbar-brand" href="/">
                    <img src="assets/images/logo.png" alt="logo" width="150" >
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/"><?= $trans->getTrans('Home'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php"><?= $trans->getTrans('Products List'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php"><?= $trans->getTrans('Order History'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php"><?= $trans->getTrans('checkout'); ?></a>
                    </li>
                </ul>
                <form class="d-flex">
                    <?php if(isset($_SESSION['user_id'])){ ?>
                    <div class="biolife-cart-info mx-auto">
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
                </form>
                </div>
            </div>
        </nav>
    </div>
</header>