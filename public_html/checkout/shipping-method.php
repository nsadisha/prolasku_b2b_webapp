<?php

use Hlakioui\API\CmsApi;
use Hlakioui\Shop\Cart;

$cmsApi = new CmsApi();
$cart = new Cart();
$cur = $cmsApi->getMainCurrency();
$trans = new \Hlakioui\Trans\Trans();
$shippingMethods = $cmsApi->getShippingMethods();
?>


<!--Navigation section-->
<div class="container d-none">
    <nav class="biolife-nav">
        <ul>
            <li class="nav-item"><a href="/" class="permal-link"><?= $trans->getTrans('Home') ?></a></li>
            <li class="nav-item"><span class="current-page"><?= $trans->getTrans('Shopping Address') ?></span></li>
        </ul>
    </nav>
</div>

<!--Hero Section-->
<div class="hero-section categories-hero-bg" style="margin: 0;">
    <h1 class="page-title"><?= $trans->getTrans('Shipping method') ?></h1>
</div>

<div class="container py-5 px-5 px-md-0">
    <div class="row">
        <div class="col">
            <div class="stepper">
                <div class="step" data-title="<?= $trans->getTrans('Billing Address') ?>">1</div>
                <hr />
                <div class="step active" data-title="<?= $trans->getTrans('Shipping method') ?>">2</div>
                <hr />
                <div class="step" data-title="<?= $trans->getTrans('Payment') ?>">3</div>
            </div>
        </div>
    </div>
</div>

<div class="page-contain shopping-cart py-5">
    <div id="main-content" class="main-content">
        <div class="container">
            <div class="row gy-5">
                <div class="col-md-8">
                    <div class="checkout-progress-wrap">
                        <ul class="steps">
                            <li class="step 1st">
                                <div class="checkout-act active">
                                    <h3 class="title-box"><?= $trans->getTrans('Shipping method') ?></h3>
                                    <div class="box-content">
                                        <div class="login-on-checkout">
                                            <form action="checkout.php?step=payment" method="post">
                                                <p class="form-row xs-margin-bottom-15px">
                                                    <label><?= $trans->getTrans('Select shipping method:') ?></label>
                                                    <select name="shipping">
                                                        <?php
                                                        foreach ($shippingMethods as $method) {
                                                            ?>
                                                            <option value="<?php echo $method['id']; ?>"><?php echo $trans->getTrans($method['title']); ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </p>
                                                <button type="submit" class="btn btn-primary btn-bold px-3 checkout pull-right" style="margin-top: 45px; "><?= $trans->getTrans('continue') ?>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php include("order_summary.php");?>
                </div>
            </div>
        </div>
    </div>
</div>
