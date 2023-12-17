<?php
declare(strict_types=1);

$trans = new \Hlakioui\Trans\Trans();

?>
<!-- FOOTER -->
<footer id="footer" class="footer layout-03">
    <div class="footer-content background-footer-03">
        <div class="container">
            <div class="row pb-3">
                <div class="col-lg-4 col-md-4">
                    <section class="footer-item">
                        <a href="index-2.html" class="logo footer-logo">
                            <img src="assets/images/logo.png" alt="logo" width="175" >
                        </a>
                        <p class="mt-3 footer-description"><?= $trans->getTrans('Footer_description'); ?></p>
                        <a href="tel:<?= $trans->getTrans('support_number') ?>" class="footer-phone-info">
                            <i class="biolife-icon icon-head-phone"></i>
                            <p class="r-info">
                                <span><?= $trans->getTrans('Got Questions ?'); ?></span>
                                <span> <?= $trans->getTrans('support_number'); ?></span>
                            </p>
                        </a>
                        <!-- <div class="newsletter-block layout-01">
                            <h4 class="title"><?= $trans->getTrans('Newsletter Signup'); ?></h4>
                            <div class="form-content">
                                <form action="#" name="new-letter-foter">
                                    <input type="email" class="input-text email" value=""
                                           placeholder="Your email here...">
                                    <button type="submit" class="bnt-submit" name="ok"><?= $trans->getTrans('Sign up'); ?></button>
                                </form>
                            </div>
                        </div> -->
                    </section>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 md-margin-top-5px sm-margin-top-50px xs-margin-top-40px">
                    <section class="footer-item">
                        <h3 class="section-title"><?= $trans->getTrans('Useful Links'); ?></h3>
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                <div class="wrap-custom-menu vertical-menu-2">
                                    <ul class="menu">
                                        <li><a href="#"><?= $trans->getTrans('About Us'); ?></a></li>
                                        <li><a href="#"><?= $trans->getTrans('About Our Shop'); ?></a></li>
                                        <li><a href="#"><?= $trans->getTrans('Secure Shopping'); ?></a></li>
                                        <li><a href="#"><?= $trans->getTrans('Delivery infomation'); ?></a></li>
                                        <li><a href="#"><?= $trans->getTrans('Privacy Policy'); ?></a></li>
                                        <li><a href="#"><?= $trans->getTrans('Our Sitemap'); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-xs-6">
                                <div class="wrap-custom-menu vertical-menu-2">
                                    <ul class="menu">
                                        <li><a href="#"><?= $trans->getTrans('Who We Are'); ?></a></li>
                                        <li><a href="#"><?= $trans->getTrans('Our Services'); ?></a></li>
                                        <li><a href="#"><?= $trans->getTrans('Projects'); ?></a></li>
                                        <li><a href="#"><?= $trans->getTrans('Contacts Us'); ?></a></li>
                                        <li><a href="#"><?= $trans->getTrans('Innovation'); ?></a></li>
                                        <li><a href="#"><?= $trans->getTrans('Testimonials'); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 md-margin-top-5px sm-margin-top-50px xs-margin-top-40px">
                    <section class="footer-item">
                        <h3 class="section-title"><?= $trans->getTrans('Transport Offices'); ?></h3>
                        <div class="contact-info-block footer-layout xs-padding-top-10px">
                            <ul class="contact-lines">
                                <li>
                                    <p class="info-item">
                                        <i class="biolife-icon icon-location"></i>
                                        <b class="desc"><?= $trans->getTrans('head_office_address'); ?></b>
                                    </p>
                                </li>
                                <li>
                                    <p class="info-item">
                                        <i class="biolife-icon icon-phone"></i>
                                        <b class="desc"><?= $trans->getTrans('head_office_phone'); ?></b>
                                    </p>
                                </li>
                                <li>
                                    <p class="info-item">
                                        <i class="biolife-icon icon-letter"></i>
                                        <b class="desc"><?= $trans->getTrans('head_office_email'); ?></b>
                                    </p>
                                </li>
                                <li>
                                    <p class="info-item">
                                        <i class="biolife-icon icon-clock"></i>
                                        <b class="desc"><?= $trans->getTrans('head_office_opening_hours'); ?></b>
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="biolife-social inline">
                            <ul class="socials">
                                <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter"
                                                                                      aria-hidden="true"></i></a></li>
                                <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook"
                                                                                       aria-hidden="true"></i></a></li>
                                <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest"
                                                                                        aria-hidden="true"></i></a></li>
                                <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube"
                                                                                      aria-hidden="true"></i></a></li>
                                <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram"
                                                                                        aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
            <hr>
            <div class="row bottom-section gy-3 py-3 pb-4">
                <!-- <div class="col-xs-12">
                    <div class="separator sm-margin-top-70px xs-margin-top-40px"></div>
                </div> -->
                <div class="col-lg-auto">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <!-- <a href="templateshub.net"><?= $trans->getTrans('Templates Hub'); ?></a></p> -->
                        <a href="/">
                            <img src="assets/images/logo_footer.png" alt="logo" width="120" class="footer-bottom-img" >
                        </a>
                    </div>
                </div>
                <div class="col-lg"></div>
                <div class="col-lg-auto">
                    <div class="payment-methods">
                        <a href="#" class="payment-link"><img src="assets/images/card1.jpg" width="40" alt=""></a>
                        <a href="#" class="payment-link"><img src="assets/images/card2.jpg" width="40" alt=""></a>
                        <a href="#" class="payment-link"><img src="assets/images/card3.jpg" width="40" alt=""></a>
                        <a href="#" class="payment-link"><img src="assets/images/card4.jpg" width="40" alt=""></a>
                        <a href="#" class="payment-link"><img src="assets/images/card5.jpg" width="40" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!--Footer For Mobile-->
<!-- <div class="mobile-footer">
    <div class="mobile-footer-inner">
        <div class="mobile-block block-menu-main">
            <a class="menu-bar menu-toggle btn-toggle" data-object="open-mobile-menu" href="javascript:void(0)">
                <span class="fa fa-bars"></span>
                <span class="text"><?= $trans->getTrans('Menu'); ?></span>
            </a>
        </div>
        <div class="mobile-block block-sidebar">
            <a class="menu-bar filter-toggle btn-toggle" data-object="open-mobile-filter" href="javascript:void(0)">
                <i class="fa fa-sliders" aria-hidden="true"></i>
                <span class="text"><?= $trans->getTrans('Sidebar'); ?></span>
            </a>
        </div>
        <div class="mobile-block block-minicart">
            <a class="link-to-cart" href="#">
                <span class="fa fa-shopping-bag" aria-hidden="true"></span>
                <span class="text"><?= $trans->getTrans('Cart'); ?></span>
            </a>
        </div>
    </div>
</div> -->

<div class="toast bg-primary text-white fade" id="toast-success" data-bs-autohide="true">
    <div class="toast-body">
    </div>
</div>

<div class="toast bg-danger text-white fade" id="toast-error" data-bs-autohide="true">
    <div class="toast-body">
    </div>
</div>