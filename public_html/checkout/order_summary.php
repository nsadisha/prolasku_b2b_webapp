<div class="order-summary sm-margin-bottom-80px">
    <div class="title-block">
        <h3 class="title"><?= $trans->getTrans('Order Summary') ?></h3>
    </div>
    <div class="cart-list-box short-type">
        <ul class="subtotal">
            <?php
            /*
        	<li>
                <div class="subtotal-line">
                    <b class="stt-name"><?= $trans->getTrans('total:') ?></b>
                    <span class="stt-price"><?php echo $cart->cartTotalPrice() ?> <?= $cur ?></span>
                </div>
            </li>*/
            ?>
            <li>
                <div class="subtotal-line">
                    <b class="stt-name"><?= $trans->getTrans('Subtotal') ?><span class="sub"></span></b>
                    <span class="stt-price"><?php echo $cart->cartSubPrice() ?> <?= $cur ?></span>
                </div>
            </li>
            <?php
            /*
            <li>
                <div class="subtotal-line">
                    <b class="stt-name"><?= $trans->getTrans('VAT') ?><span class="sub"></span></b>
                    <span class="stt-price"><?php echo($cart->cartTotalPrice() - $cart->cartSubPrice()) ?> <?= $cur ?></span>
                </div>
            </li>*/
            ?>
        </ul>
    </div>
</div>
 