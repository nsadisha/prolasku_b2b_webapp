<?php
declare(strict_types=1);

use Hlakioui\API\CmsApi;
use Hlakioui\DotEnv\DotEnv;

require_once dirname(__DIR__) . '/vendor/autoload.php';
(new DotEnv(__DIR__ . '/../.env'))->load();

if (getenv('APP_APP_ENV') == 'dev') {
    ini_set('display_errors', 'true');
    ini_set('display_startup_errors', 'true');
    error_reporting(E_ALL);
}

session_start();

if (!isset($_SESSION["logIn"]) && $_SESSION["logIn"] != true)
{
    header("Location: /login.php");
    exit;
}

$cmsApi = new CmsApi();

// $cmsApi->pr($_SESSION["logIn"]);die;
// $cmsApi->pr($cmsApi->getMainLang());die;
// $cmsApi->pr($cmsApi);die;
$language = $cmsApi->getMainLang();
if ($language===false)
{
    header("Location: /login.php");
    exit;
}
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
    include('pages/home.php');
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

