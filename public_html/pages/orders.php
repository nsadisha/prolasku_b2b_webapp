<?php
declare(strict_types=1);
use Hlakioui\API\CmsApi;
$cmsApi = new CmsApi();

$cur = $cmsApi->getMainCurrency();
$language = $cmsApi->getMainLang();
$lang = $language['code'];
$trans = new \Hlakioui\Trans\Trans();

?>
<!--Hero Section-->
<div class="hero-section hero-background" style="margin: 0;">
    <h1 class="page-title"><?= $trans->getTrans('Orders History') ?></h1>
</div>

<!--Navigation section-->
<div class="container">
    <nav class="biolife-nav">
        <ul>
            <li class="nav-item"><a href="/" class="permal-link"><?= $trans->getTrans('Home') ?></a></li>
            <li class="nav-item"><span class="current-page"><?= $trans->getTrans('Orders History') ?></span></li>
        </ul>
    </nav>
</div>


<div class="page-contain login-page">
    <!-- Main content -->
    <div id="main-content" class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="orders-filter">
                        <div class="orders-years d-none">
                            <?php
                                $current = new DateTime();
                                $year = $current->format('Y');
                                $month = $current->format('m');
                                if (isset($_GET['y'])) {
                                    $year = $_GET['y'];
                                }

                                if (isset($_GET['m'])) {
                                    $month = $_GET['m'];
                                }

                                $lastYear = new DateTime($year . '-01-01');
                                $lastYear->modify('- 1 year');

                                $nextYear = new DateTime($year . '-01-01');
                                $nextYear->modify('+ 1 year');
                            ?>
                            <a href="orders.php?y=<?php echo $lastYear->format("Y"); ?>" class="btn btn-primary last-year"><?php echo $lastYear->format('Y'); ?></a>
                            <a href="orders.php?y=<?php echo $year; ?>" class="btn btn-primary next-year"><?php echo $year; ?></a>
                            <a href="orders.php?y=<?php echo $nextYear->format('Y'); ?>" class="btn btn-primary current-year"><?php echo $nextYear->format('Y'); ?></a>
                        </div>
                        <ul class="order-filter-list list-inline d-none">
                            <?php
                            $begin = (new DateTime($year . '-01-01'))->modify('first day of january');
                            $end = (new DateTime($year . '-01-01'))->modify('last day of December');

                            $interval = DateInterval::createFromDateString('1 month');
                            $period = new DatePeriod($begin, $interval, $end);

                            foreach ($period as $dt) {
                                ?>
                                <li class="list<?php $dt->format('Y-m') == (new DateTime($year . '-' . $month . '-01'))->format('Y-m') ? print ' active' : print '' ?>">
                                    <a href="orders.php?m=<?php echo $dt->format("m"); ?>&y=<?php echo $dt->format("Y"); ?>"><?php echo $dt->format("M-Y"); ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex justify-content-center justify-content-md-end">
                        <?php
                            $current = new DateTime();
                            $year = $current->format('Y');
                            $month = $current->format('m');
                            if (isset($_GET['y'])) {
                                $year = $_GET['y'];
                            }

                            if (isset($_GET['m'])) {
                                $month = $_GET['m'];
                            }

                            $lastYear = new DateTime($year . '-01-01');
                            $lastYear->modify('- 1 year');

                            $nextYear = new DateTime($year . '-01-01');
                            $nextYear->modify('+ 1 year');
                        ?>

                        <div>
                            <div class="year-selector">
                                <a href="orders.php?y=<?= $lastYear->format("Y"); ?>">
                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                </a>
                                <a href="#"><strong><?= $year; ?></strong></a>
                                <a href="orders.php?y=<?= $nextYear->format("Y"); ?>">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>

                        <div class="custom-dropdown ms-3">
                            <span class="label">Select month</span>
                            <ul>
                                <?php
                                    $begin = (new DateTime($year . '-01-01'))->modify('first day of january');
                                    $end = (new DateTime($year . '-01-01'))->modify('last day of December');

                                    $interval = DateInterval::createFromDateString('1 month');
                                    $period = new DatePeriod($begin, $interval, $end);

                                    foreach ($period as $dt) {
                                        ?>
                                        <li class="<?php $dt->format('Y-m') == (new DateTime($year . '-' . $month . '-01'))->format('Y-m') ? print 'active' : print '' ?>">
                                            <a href="orders.php?m=<?php echo $dt->format("m"); ?>&y=<?php echo $dt->format("Y"); ?>"><?php echo $dt->format("M"); ?></a>
                                        </li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 py-5">
                    <div class="advance-product-box">
                        <div class="biolife-title-box bold-style biolife-title-box__bold-style" style="margin-top: 0;">
                            <h3 class="title"><?= $trans->getTrans('Order list') ?></h3>
                        </div>
                        <div class="products eq-height-contain nav-center-03 nav-none-on-mobile row-space-29px"
                             style="list-style: none;">
                            <?php
                            if (!empty($orders['message'])) {
                                ?>
                                <h5><?= $trans->getTrans('no order available for this month') ?></h5>
                                <?php
                            } else {
                                foreach ($orders as $order) {
                                    if (isset($order['id'])) {

                                        $_ORDER_STATUS_DATA = $cmsApi->order_status_data($order['status']);
                                        ?>
                                        <div class="card order-card mb-3">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div class="top">
                                                    <div class="d-flex">
                                                        <a href="order.php?id=<?php echo $order['id'] ?>">
                                                            <h5 class="card-title"><strong>#<?php echo $order['id'] ?? '' ?></strong></h5>
                                                        </a>
                                                        <span class="status ms-3 text-<?=$_ORDER_STATUS_DATA['color']?>">
                                                            <i class="fa fa-circle" style="font-size: 0.9rem;" aria-hidden="true"></i>
                                                            <?=$trans->getTrans($_ORDER_STATUS_DATA['title'])?>
                                                        </span>
                                                    </div>
                                                    <p class="card-text"><?php echo $order['order_date'] ?? '' ?></p>
                                                </div>
                                                <span class="price"><strong><?= $cur ?><?= $order['total'] ?? '' ?></strong></span>
                                            </div>
                                        </div>

                                        <div class="product-item p-2 d-none">
                                            <div class="contain-product right-info-layout contain-product__right-info-layout">
                                                <div class="info" style="position: relative;">
                                                    <h4 class="product-title">
                                                        <a href="order.php?id=<?php echo $order['id'] ?>" class="bold pr-name">#<?php echo $order['id'] ?? '' ?></a>
                                                        <span class="p-l-sm text-<?=$_ORDER_STATUS_DATA['color']?>"><?=$trans->getTrans($_ORDER_STATUS_DATA['title'])?></span>
                                                    </h4>
                                                    <div class="price" style="position: absolute;top: 0;right: 10px;">
                                                        <ins>
                                                            <span class="price-amount">
                                                                <span class="currencySymbol"><?= $cur ?></span>
                                                                <?php echo $order['total'] ?? '' ?>
                                                            </span>
                                                        </ins>
                                                    </div>
                                                    <div class="rating">
                                                        <span class="review-count"><?php echo $order['order_date'] ?? '' ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>