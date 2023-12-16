<?php

$countries = $cmsApi->getCountries();
$cities = $cmsApi->getCities();
$trans = new \Hlakioui\Trans\Trans();

?>

<!--Hero Section-->
<div class="hero-section categories-hero-bg" style="margin: 0;">
    <h1 class="page-title"><?= $trans->getTrans('Billing Address') ?></h1>
</div>

<div class="container py-5 px-5 px-md-0">
    <div class="row">
        <div class="col">
            <div class="stepper">
                <div class="step active" data-title="<?= $trans->getTrans('Billing Address') ?>">1</div>
                <hr />
                <div class="step" data-title="<?= $trans->getTrans('Shipping method') ?>">2</div>
                <hr />
                <div class="step" data-title="<?= $trans->getTrans('Payment') ?>">3</div>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="page-contain shopping-cart py-5">
    <div class="container">
        <div class="row checkout-progress-wrap gy-5">
            <div class="col-md-8">
                <div class="checkout-act">
                    <form action="checkout.php?step=shipping-method" method="post">
                        <div class="shipping-address">
                            <h3 class="title-box"><?= $trans->getTrans('Billing Address') ?> </h3>
                            <div class="box-content">
                                <div class="login-on-checkout row">
                                    <p class="form-row col-md-6">
                                        <label><?= $trans->getTrans('Full name') ?></label>
                                        <input type="text" name="name"
                                                value="<?php echo ($customer['firstname'] ?? '')?>"
                                                required placeholder="full name">
                                    </p>
                                    <p class="form-row col-md-6">
                                        <label><?= $trans->getTrans('Email Address') ?></label>
                                        <input type="email" name="email" style="line-height: 24px;"
                                                value="<?php echo $customer['email'] ?? '' ?>" required
                                                placeholder="Email Address">
                                    </p>
                                    <p class="form-row phone col-md-12">
                                        <label><?= $trans->getTrans('Phone Number') ?></label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" class="prefix"
                                                    value="<?php echo (!empty($customer['phone_prefix']) ? $customer['phone_prefix'] : '')?>"
                                                    name="phone_prefix">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="number"
                                                    value="<?php echo (!empty($customer['phone']) ? $customer['phone'] : '')?>" required
                                                    name="phone" placeholder="phone">
                                            </div>
                                        </div>
                                    </p>
                                    <p class="form-row col-md-6">
                                        <label><?= $trans->getTrans('Trade name') ?></label>
                                        <input type="text"
                                                value="<?php echo (!empty($customer['lastname']) ? $customer['lastname'] : '') ?>"
                                                name="lastname" required placeholder="Trade name">
                                    </p>
                                    <p class="form-row col-md-6">
                                        <label><?= $trans->getTrans('company') ?></label>
                                        <input type="text"
                                                value="<?php echo (!empty($customer['company']) ? $customer['company'] : '')?>"
                                                name="company" required placeholder="company">
                                    </p>
                                    <p class="form-row col-md-6">
                                        <label><?= $trans->getTrans('Business id') ?></label>
                                        <input type="text"
                                                value="<?php echo (!empty($customer['business_id']) ? $customer['business_id'] : '') ?>"
                                                name="business_id" required placeholder="Business id">
                                    </p>
                                    <p class="form-row col-md-6">
                                        <label><?= $trans->getTrans('website') ?></label>
                                        <input value="<?php echo (!empty($customer['website']) ? $customer['website'] : '') ?>"
                                                type="text"
                                                required name="website">
                                    </p>
                                    <p class="form-row col-md-6">
                                        <label><?= $trans->getTrans('Address line 1') ?></label>
                                        <input id="billing-address" type="text"
                                                value="<?php echo $customer['address'] ?? '' ?>"
                                                name="address" required placeholder="address line">
                                    </p>
                                    <p class="form-row col-md-6">
                                        <label><?= $trans->getTrans('Postal') ?></label>
                                        <input type="text"
                                                value="<?php echo $customer['postal'] ?? '' ?>"
                                                name="postal" required placeholder="zip code">
                                    </p>
                                    <p class="form-row col-md-6">
                                        <label><?= $trans->getTrans('State') ?></label>
                                        <input type="text"
                                                value="<?php echo (!empty($customer['state']) ? $customer['state'] : '') ?>"
                                                name="state" required placeholder="state">
                                    </p>
                                    <div class="form-row col-md-6">
                                        <label><?= $trans->getTrans('city') ?></label>
                                        <select id="billing-city" name="city_id" required class="" style="line-height:24px !important;">
                                            <option value="-1">All cities</option>
                                            <?php
                                            foreach ($cities as $city) {
                                                ?>
                                                <option <?php if ($city['city_id'] == $customer['city_id']) {
                                                    echo "selected";
                                                } ?>
                                                        value="<?php echo $city['city_id'] ?>"><?php echo $city['city_name'][$lang] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-row col-md-6">
                                        <label><?= $trans->getTrans('Country') ?></label>
                                        <select id="billing-country" name="country_id" required
                                                class="">
                                            <option value="-1"><?= $trans->getTrans('All countries') ?></option>
                                            <?php
                                            foreach ($countries as $country) {
                                                ?>
                                                <option <?php if ($country['country_id'] == $customer['country_id']) {
                                                    echo "selected";
                                                } ?>
                                                        value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'][$lang] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <p class="form-row col-md-6">
                                        <label><?= $trans->getTrans('Billing Email') ?></label>
                                        <input value="<?php echo $customer['billing_email'] ?? '' ?>"
                                                type="text" required name="billing_email">
                                    </p>
                                    <p class='form-row col-md-6'>
                                        <label><?= $trans->getTrans('Delivery contact person') ?></label>
                                        <input id="delivery_contact_person" type='text' required name='delivery_contact_person'
                                            <?php if ($customer['different_shipping_address'] == 1) { echo 'required';} ?>
                                                value="<?= $customer['delivery_contact_person'] ?>">
                                    </p>
                                    <p class="form-row col-md-6">
                                        <label><?= $trans->getTrans('Ordering Email') ?></label>
                                        <input value="<?php echo $customer['ordering_email'] ?? '' ?>"
                                                type="text" required name="ordering_email">
                                    </p>
                                    <p class="form-row col-md-6">
                                        <label><?= $trans->getTrans('is the shipping address different?') ?>
                                            <input class="is-different-address"
                                                    name="different_shipping_address"
                                                    type="checkbox" <?php if ($customer['different_shipping_address'] == 1) { echo 'checked';} ?>>
                                        </label>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="billing-address" style="margin-top: 45px; margin-bottom: 45px; <?php if ($customer['different_shipping_address'] == 0) { echo "display: none"; } ?>">
                            <h3 class='title-box'><?= $trans->getTrans('shipping Address') ?></h3>
                            <div class='box-content'>
                                <div class='login-on-checkout'>
                                    <p class='form-row'>
                                        <label><?= $trans->getTrans('Shipping Address') ?></label>
                                        <input id='shipping-address' type='text'
                                                value="<?= $customer['shipping_address'] ?>"
                                                name='shipping_address'  <?php if ($customer['different_shipping_address'] == 1) { echo 'required';} ?>
                                                placeholder='address line 1'>
                                    </p>
                                    <div class='form-row'>
                                        <label><?= $trans->getTrans('Shipping city') ?></label>
                                        <select id='shipping-city' name='shipping_city_id' <?php if ($customer['different_shipping_address'] == 1) { echo 'required';} ?>
                                                class=''>
                                            <option value="-1">All cities</option>
                                            <?php
                                            foreach ($cities as $city) {
                                                ?>
                                                <option <?php if ($city['city_id'] == $customer['shipping_city_id']) {
                                                    echo "selected";
                                                } ?>
                                                        value="<?php echo $city['city_id'] ?>"><?php echo $city['city_name'][$lang] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class='form-row'>
                                        <label><?= $trans->getTrans('Shipping Country') ?></label>
                                        <select id='shipping-country' name='shipping_country_id'
                                            <?php if ($customer['different_shipping_address'] == 1) { echo 'required';} ?> class=''>
                                            <option value="-1"><?= $trans->getTrans('All countries') ?></option>
                                            <?php
                                            foreach ($countries as $country) {
                                                ?>
                                                <option <?php if ($country['country_id'] == $customer['shipping_country_id']) {
                                                    echo "selected";
                                                } ?>
                                                        value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'][$lang] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <p class='form-row'>
                                        <label><?= $trans->getTrans('Shipping Postal') ?></label>
                                        <input id='shipping-postal'
                                                type='text' <?= $customer['shipping_postal'] ?>
                                                value="<?= $customer['shipping_postal'] ?>"
                                                name='shipping_postal' <?php if ($customer['different_shipping_address'] == 1) { echo 'required';} ?>
                                                placeholder='zip code'>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <input type="submit" class="btn btn-primary btn-bold px-3 ms-auto" value="<?= $trans->getTrans('continue') ?>">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php include("order_summary.php");?>
            </div>
        </div>
    </div>
</div>

<div class="page-contain shopping-cart py-5 d-none">
    <!-- Main content -->
    <div id="main-content" class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                    <div class="checkout-progress-wrap">
                        <ul class="steps">
                            <li class="step 1st">
                                <div class="checkout-act active">

                                    <form action="checkout.php?step=shipping-method" method="post">
                                        <div class="shipping-address">
                                            <h3 class="title-box"><?= $trans->getTrans('Billing Address') ?>
                                            </h3>
                                            <div class="box-content">
                                                <div class="login-on-checkout">
                                                    <p class="form-row">
                                                        <label><?= $trans->getTrans('Full name') ?></label>
                                                        <input type="text" name="name"
                                                               value="<?php echo ($customer['firstname'] ?? '')?>"
                                                               required placeholder="full name">
                                                    </p>
                                                    <p class="form-row">
                                                        <label><?= $trans->getTrans('Email Address') ?></label>
                                                        <input type="email" name="email"
                                                               value="<?php echo $customer['email'] ?? '' ?>" required
                                                               placeholder="Email Address">
                                                    </p>
                                                    <p class="form-row phone">
                                                        <label><?= $trans->getTrans('Phone Number') ?></label>
                                                        <input type="text" class="prefix"
                                                               value="<?php echo (!empty($customer['phone_prefix']) ? $customer['phone_prefix'] : '')?>"
                                                               name="phone_prefix">
                                                        <input type="text" class="number"
                                                               value="<?php echo (!empty($customer['phone']) ? $customer['phone'] : '')?>" required
                                                               name="phone" placeholder="phone">
                                                    </p>
                                                    <p class="form-row">
                                                        <label><?= $trans->getTrans('Trade name') ?></label>
                                                        <input type="text"
                                                               value="<?php echo (!empty($customer['lastname']) ? $customer['lastname'] : '') ?>"
                                                               name="lastname" required placeholder="Trade name">
                                                    </p>
                                                    <p class="form-row">
                                                        <label><?= $trans->getTrans('company') ?></label>
                                                        <input type="text"
                                                               value="<?php echo (!empty($customer['company']) ? $customer['company'] : '')?>"
                                                               name="company" required placeholder="company">
                                                    </p>
                                                    <p class="form-row">
                                                        <label><?= $trans->getTrans('Business id') ?></label>
                                                        <input type="text"
                                                               value="<?php echo (!empty($customer['business_id']) ? $customer['business_id'] : '') ?>"
                                                               name="business_id" required placeholder="Business id">
                                                    </p>
                                                    <p class="form-row">
                                                        <label><?= $trans->getTrans('website') ?></label>
                                                        <input value="<?php echo (!empty($customer['website']) ? $customer['website'] : '') ?>"
                                                               type="text"
                                                               required name="website">
                                                    </p>
                                                    <p class="form-row">
                                                        <label><?= $trans->getTrans('Address line 1') ?></label>
                                                        <input id="billing-address" type="text"
                                                               value="<?php echo $customer['address'] ?? '' ?>"
                                                               name="address" required placeholder="address line">
                                                    </p>
                                                    <p class="form-row">
                                                        <label><?= $trans->getTrans('Postal') ?></label>
                                                        <input type="text"
                                                               value="<?php echo $customer['postal'] ?? '' ?>"
                                                               name="postal" required placeholder="zip code">
                                                    </p>
                                                    <p class="form-row">
                                                        <label><?= $trans->getTrans('State') ?></label>
                                                        <input type="text"
                                                               value="<?php echo (!empty($customer['state']) ? $customer['state'] : '') ?>"
                                                               name="state" required placeholder="state">
                                                    </p>
                                                    <div class="form-row">
                                                        <label><?= $trans->getTrans('city') ?></label>
                                                        <select id="billing-city" name="city_id" required class="">
                                                            <option value="-1">All cities</option>
                                                            <?php
                                                            foreach ($cities as $city) {
                                                                ?>
                                                                <option <?php if ($city['city_id'] == $customer['city_id']) {
                                                                    echo "selected";
                                                                } ?>
                                                                        value="<?php echo $city['city_id'] ?>"><?php echo $city['city_name'][$lang] ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-row">
                                                        <label><?= $trans->getTrans('Country') ?></label>
                                                        <select id="billing-country" name="country_id" required
                                                                class="">
                                                            <option value="-1"><?= $trans->getTrans('All countries') ?></option>
                                                            <?php
                                                            foreach ($countries as $country) {
                                                                ?>
                                                                <option <?php if ($country['country_id'] == $customer['country_id']) {
                                                                    echo "selected";
                                                                } ?>
                                                                        value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'][$lang] ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <p class="form-row">
                                                        <label><?= $trans->getTrans('Billing Email') ?></label>
                                                        <input value="<?php echo $customer['billing_email'] ?? '' ?>"
                                                               type="text" required name="billing_email">
                                                    </p>
                                                    <p class='form-row'>
                                                        <label><?= $trans->getTrans('Delivery contact person') ?></label>
                                                        <input id="delivery_contact_person" type='text' required name='delivery_contact_person'
                                                            <?php if ($customer['different_shipping_address'] == 1) { echo 'required';} ?>
                                                               value="<?= $customer['delivery_contact_person'] ?>">
                                                    </p>
                                                    <p class="form-row">
                                                        <label><?= $trans->getTrans('Ordering Email') ?></label>
                                                        <input value="<?php echo $customer['ordering_email'] ?? '' ?>"
                                                               type="text" required name="ordering_email">
                                                    </p>
                                                    <p class="form-row">
                                                        <label><?= $trans->getTrans('is the shipping address different?') ?>
                                                            <input class="is-different-address"
                                                                   name="different_shipping_address"
                                                                   type="checkbox" <?php if ($customer['different_shipping_address'] == 1) { echo 'checked';} ?>>
                                                        </label>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="billing-address" style="margin-top: 45px; <?php if ($customer['different_shipping_address'] == 0) { echo "display: none"; } ?>">
                                            <h3 class='title-box'><?= $trans->getTrans('shipping Address') ?></h3>
                                            <div class='box-content'>
                                                <div class='login-on-checkout'>
                                                    <p class='form-row'>
                                                        <label><?= $trans->getTrans('Shipping Address') ?></label>
                                                        <input id='shipping-address' type='text'
                                                               value="<?= $customer['shipping_address'] ?>"
                                                               name='shipping_address'  <?php if ($customer['different_shipping_address'] == 1) { echo 'required';} ?>
                                                               placeholder='address line 1'>
                                                    </p>
                                                    <div class='form-row'>
                                                        <label><?= $trans->getTrans('Shipping city') ?></label>
                                                        <select id='shipping-city' name='shipping_city_id' <?php if ($customer['different_shipping_address'] == 1) { echo 'required';} ?>
                                                                class=''>
                                                            <option value="-1">All cities</option>
                                                            <?php
                                                            foreach ($cities as $city) {
                                                                ?>
                                                                <option <?php if ($city['city_id'] == $customer['shipping_city_id']) {
                                                                    echo "selected";
                                                                } ?>
                                                                        value="<?php echo $city['city_id'] ?>"><?php echo $city['city_name'][$lang] ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class='form-row'>
                                                        <label><?= $trans->getTrans('Shipping Country') ?></label>
                                                        <select id='shipping-country' name='shipping_country_id'
                                                            <?php if ($customer['different_shipping_address'] == 1) { echo 'required';} ?> class=''>
                                                            <option value="-1"><?= $trans->getTrans('All countries') ?></option>
                                                            <?php
                                                            foreach ($countries as $country) {
                                                                ?>
                                                                <option <?php if ($country['country_id'] == $customer['shipping_country_id']) {
                                                                    echo "selected";
                                                                } ?>
                                                                        value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'][$lang] ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <p class='form-row'>
                                                        <label><?= $trans->getTrans('Shipping Postal') ?></label>
                                                        <input id='shipping-postal'
                                                               type='text' <?= $customer['shipping_postal'] ?>
                                                               value="<?= $customer['shipping_postal'] ?>"
                                                               name='shipping_postal' <?php if ($customer['different_shipping_address'] == 1) { echo 'required';} ?>
                                                               placeholder='zip code'>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-primary pull-right" value="<?= $trans->getTrans('continue') ?>">
                                    </form>
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
