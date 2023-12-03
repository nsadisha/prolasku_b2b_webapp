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
<div class="container">
    <nav class="biolife-nav">
        <ul>
            <li class="nav-item"><a href="/" class="permal-link"><?= $trans->getTrans('Home') ?></a></li>
            <li class="nav-item"><span class="current-page"><?= $trans->getTrans('Shopping Address') ?></span></li>
        </ul>
    </nav>
</div>

<div class="page-contain shopping-cart">
    <!-- Main content -->
    <div id="main-content" class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                    <div class="checkout-progress-wrap">
                        <ul class="steps">
                            <li class="step 1st">
                                <div class="checkout-act active">
                                    <h3 class="title-box"><span class="number">2</span><?= $trans->getTrans('Shipping method') ?></h3>
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
                                                <button type="submit" class="btn btn-primary checkout pull-right" style="margin-top: 45px; "><?= $trans->getTrans('continue') ?>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 sm-padding-top-48px sm-margin-bottom-0 xs-margin-bottom-15px">
                    <?php include("order_summary.php");?>
                </div>
            </div>
        </div>
    </div>
</div>
