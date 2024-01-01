<?php

$total_price = 0;
$total_item = 0;
$output = '';

?>

<!-- Modal -->
<div class="modal fade" id="floating-cart-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="cart-item-list" id="floating-cart-items"></ul>
            </div>
        </div>
    </div>
</div>