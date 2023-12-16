<?php

use Hlakioui\API\CmsApi;
use Hlakioui\Shop\Cart;

$cmsApi = new CmsApi();
$cart = new Cart();
$cur = $cmsApi->getMainCurrency();

$paymentMethods = $available_payment_methods = $cmsApi->getPaymentMethods();
// $cmsApi->pr($paymentMethods,1);
$trans = new \Hlakioui\Trans\Trans();

$customer = $cmsApi->getCustomer((int)$_SESSION['user_id']);
// $cmsApi->pr($customer,1);

if(isset($customer['available_payment_methods']) && !empty($customer['available_payment_methods']) ){
    $available_payment_methods = array();
    foreach ($paymentMethods as $apm) {
        if(in_array($apm['id'], $customer['available_payment_methods'])){
            $available_payment_methods[] = $apm;
        }
    }
}

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
    <h1 class="page-title"><?= $trans->getTrans('Payment') ?></h1>
</div>

<div class="container py-5 px-5 px-md-0">
    <div class="row">
        <div class="col">
            <div class="stepper">
                <div class="step" data-title="<?= $trans->getTrans('Billing Address') ?>">1</div>
                <hr />
                <div class="step" data-title="<?= $trans->getTrans('Shipping method') ?>">2</div>
                <hr />
                <div class="step active" data-title="<?= $trans->getTrans('Payment') ?>">3</div>
            </div>
        </div>
    </div>
</div>

<div class="page-contain shopping-cart">
    <!-- Main content -->
    <div id="main-content" class="main-content">
        <div class="container">
            <div class="row gy-5">
                <div class="col-md-8">
                    <div class="checkout-progress-wrap">
                        <ul class="steps">
                            <li class="step 1st">
                                <div class="checkout-act active">
                                    <h3 class="title-box"><?= $trans->getTrans('Payment') ?></h3>
                                    <div class="box-content">
                                        <div class="login-on-checkout">
                                            <?php if(!empty($available_payment_methods)){ ?>
                                                <form action="checkout.php?step=thank-you" method="post">
                                                    <select name="payment">
                                                        <?php
                                                        foreach ($available_payment_methods as $paymentMethod) {
                                                            ?>
                                                            <option value="<?=$paymentMethod['id']; ?>"><i class="<?=$paymentMethod['icon']?>"></i> <?=$trans->getTrans($paymentMethod['title']); ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary btn-bold px-3 checkout pull-right" style="margin-top: 45px; "><?= $trans->getTrans('Check out') ?></button>
                                                </form>
                                            <?php }else{ 
                                                echo $trans->getTrans('please_ask_admin_for_payment_methods');
                                            }?>
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
