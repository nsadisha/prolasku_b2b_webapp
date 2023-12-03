<?php
declare(strict_types=1);

use Hlakioui\API\CmsApi;
use Hlakioui\Shop\Cart;
use Hlakioui\DotEnv\DotEnv;


require_once dirname(__DIR__) . '/vendor/autoload.php';
(new DotEnv(__DIR__ . '/../.env'))->load();

if (getenv('APP_APP_ENV') == 'dev') {
    ini_set('display_errors', 'true');
    ini_set('display_startup_errors', 'true');
    error_reporting(E_ALL);
}

session_start();



if (empty($_SESSION["shopping_cart"])) {
    header("Location: /cart.php");
    exit;
}

if (!isset($_SESSION["logIn"]) && $_SESSION["logIn"] != true) {
    header("Location: /login.php");
    exit;
}

$cmsApi = new CmsApi();
$cart = new Cart();
$language = $cmsApi->getMainLang();
$lang = $language['code'];

?>

    <!DOCTYPE html>
    <html class="no-js" lang="en">

    <?php
    include('html/head.php');
    ?>
    <body class="biolife-body">

    <!-- Preloader -->
    <div id="biof-loading">
        <div class="biof-loading-center">
            <div class="biof-loading-center-absolute">
                <div class="dot dot-one"></div>
                <div class="dot dot-two"></div>
                <div class="dot dot-three"></div>
            </div>
        </div>
    </div>

    <?php
    include('pages/header.php');
    ?>

    <!-- Page Contain -->
    <div class="page-contain">
        <?php
        $step = $_GET['step'] ?? 'address';
        if ($step == 'address') {
            $customer = $cmsApi->getCustomer((int)$_SESSION['user_id']);
            require 'checkout/address.php';
        } elseif ($step == 'shipping-method') {
            if (isset($_POST)) {
                $cmsApi->setAddress($_POST);
                $cmsApi->updateCustomerAddress($_POST);
                require 'checkout/shipping-method.php';
            }
        } elseif ($step == 'payment') {
            if (isset($_POST)) {
                $cmsApi->setShipping($_POST);
                require 'checkout/payment.php';
            }
        } elseif ($step == 'thank-you') {
            if (isset($_POST)) {
                $cmsApi->setPayment($_POST);
                $order = $cmsApi->setSendOrder();
                
                if ($order['response_type'] == 'success') {
                    unset($_SESSION['order']);
                    unset($_SESSION['shopping_cart']);
                    require 'checkout/thank-you.php';
                }else{
                    require 'checkout/send-order-error.php';
                }
            }
        }
        ?>
    </div>

    <?php
    include('pages/footer.php');
    ?>

    <!-- Scroll Top Button -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <?php
    include('html/footer.php');
    ?>
    </body>
    </html>
<?php


