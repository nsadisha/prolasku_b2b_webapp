<?php
$trans = new \Hlakioui\Trans\Trans();

// $cmsApi->pr("I am here!!!");
?>
<div id="main-content" class="main-content">
    <!--Products Block: Product Tab-->
    <div class="why-choose-us-block py-5 bg-white">
        <div class="container text-center">
            <h3 class="box-title"><?= $trans->getTrans('Order confirmed') ?></h3>
            <h4><?= $trans->getTrans('Your order number is') ?></h4>
            <a href="order.php?id=<?php echo $order['id'] ?>">
                <strong style="color:#196d52; font-size: 25px;display: block;line-height: 1.6;">#<?php echo $order['id'] ?></strong>
            </a>
            <b class="subtitle"><?= $trans->getTrans('Your order was completed successfully') ?></b>
        </div>
    </div>
</div>