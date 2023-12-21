<!--Hero Section-->
<!-- <div class="hero-section hero-background" style="margin: 0;">
    <h1 class="page-title"><?= $trans->getTrans('Authentication') ?></h1>
</div> -->

<?php if(isset($_SESSION['user_id'])){ ?>
<!--Navigation section-->
<div class="container">
    <nav class="biolife-nav">
        <ul>
            <li class="nav-item"><a href="index.php" class="permal-link"><?= $trans->getTrans('Home') ?></a></li>
            <li class="nav-item"><span class="current-page"><?= $trans->getTrans('Authentication') ?></span></li>
        </ul>
    </nav>
</div>
<?php } ?>

<div class="page-contain login-page">
    <!-- Main content -->
    <div id="main-content" class="main-content">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <!--Form Sign In-->
                <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                    <div class="signin-container">
                        <form id="login-form" name="frm-login" method="post">
                            <h2 class="my-0 mb-4"><?= $trans->getTrans('Login') ?></h2>
                            <p class="form-row">
                                <label for="fid-email"><?= $trans->getTrans('Email Address:') ?><span class="requite">*</span></label>
                                <input type="text" id="fid-email" name="email" value="" class="txt-input" required>
                            </p>
                            <p class="form-row">
                                <label for="fid-pass"><?= $trans->getTrans('Password:') ?><span class="requite">*</span></label>
                                <input type="password" id="fid-pass" name="password" value="" class="txt-input"
                                       required>
                            </p>
                            <div class="invalid-feedback"></div>
                        </form>
                        <p class="form-row wrap-btn">
                            <button id="login-submit" class="btn btn-submit btn-bold"><?= $trans->getTrans('sign in') ?></button>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row d-none">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p><strong><?= $trans->getTrans('Are you a private customer?') ?></strong></p>

                    <p><?= $trans->getTrans('Please login to our webshop') ?><a href="../">  <?= $trans->getTrans('here') ?></a></p>

                    <p>&nbsp;</p>

                    <p><strong><?= $trans->getTrans('Interested in a B2B Registration?') ?></strong></p>

                    <p><?= $trans->getTrans('Please fill our online business registration form') ?>  <a href="../"><?= $trans->getTrans('here') ?></a></p>

                    <p>&nbsp;</p>

                    <p><strong><?= $trans->getTrans('Already a B2B customer but you cannot login?') ?></strong></p>

                    <p><?= $trans->getTrans('Please send us an inquiry here or contact us via our phone: 0931588830') ?></p>

                    <p>&nbsp;</p>

                    <p><strong><?= $trans->getTrans('Disclaimers:') ?></strong></p>

                    <p><span style="color:#c0392b"><?= $trans->getTrans('This website is provided to our B2B (Business to Business customers). Each customer is able to view order history and re-purchase previous orders.') ?></span></p>

                    <p><strong><?= $trans->getTrans('Privacy and policy:') ?></strong></p>

                    <p><span style="color:#c0392b"><?= $trans->getTrans('We will collect your IP address') ?></span></p>

                    <p><br /></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row row-cols-1 row-cols-md-3 gy-3">
        <div class="col">
            <div class="card py-3">
                <div class="card-body text-center">
                    <i class="fa fa-user mb-3" style="font-size: 5rem;" aria-hidden="true"></i>
                    <h6 class="card-subtitle mb-2 text-muted"><strong><?= $trans->getTrans('Are you a private customer?') ?></strong></h6>
                    <p class="card-text"><?= $trans->getTrans('Please login to our webshop') ?></p>
                    <a href="../" class="card-link"><?= $trans->getTrans('here') ?></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card py-3">
                <div class="card-body text-center">
                    <i class="fa fa-handshake-o mb-3" style="font-size: 5rem;" aria-hidden="true"></i>
                    <h6 class="card-subtitle mb-2 text-muted"><strong><?= $trans->getTrans('Interested in a B2B Registration?') ?></strong></h6>
                    <p class="card-text"><?= $trans->getTrans('Please fill our online business registration form') ?></p>
                    <a href="../" class="card-link"><?= $trans->getTrans('here') ?></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card py-3">
                <div class="card-body text-center">
                    <i class="fa fa-question-circle-o mb-3" style="font-size: 5rem;" aria-hidden="true"></i>
                    <h6 class="card-subtitle mb-2 text-muted"><strong><?= $trans->getTrans('Already a B2B customer but you cannot login?') ?></strong></h6>
                    <p class="card-text"><?= $trans->getTrans('Please send us an inquiry here or contact us via our phone: 0931588830') ?></p>
                    <!-- <a href="../" class="card-link"><?= $trans->getTrans('here') ?></a> -->
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 mt-3 gy-4">
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fa fa-exclamation-triangle mb-3" style="font-size: 5rem;" aria-hidden="true"></i>
                    <h6 class="card-subtitle mb-2 text-muted"><strong><?= $trans->getTrans('Disclaimers:') ?></strong></h6>
                    <p class="card-text"><?= $trans->getTrans('This website is provided to our B2B (Business to Business customers). Each customer is able to view order history and re-purchase previous orders.') ?></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fa fa-user-secret mb-3" style="font-size: 5rem;" aria-hidden="true"></i>
                    <h6 class="card-subtitle mb-2 text-muted"><strong><?= $trans->getTrans('Privacy and policy:') ?></strong></h6>
                    <p class="card-text"><?= $trans->getTrans('We will collect your IP address') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>