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

$cmsApi = new CmsApi();

$cur = $cmsApi->getMainCurrency();
$language = $cmsApi->getMainLang();
$langId = $language['id'];
$trans = new \Hlakioui\Trans\Trans();


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
    include('pages/login.php');
    ?>
</div>

<!-- Scroll Top Button -->
<a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

<?php
include('html/footer.php');
?>
<script type="text/javascript">
    function IS_JSON(str){
        var IS_JSON_str = true;
        try
        {
            var json = jQuery.parseJSON(str);
        }
        catch(err)
        {
            IS_JSON_str = false;
        }    
    }
    ;(function ($) {
        $("#login-submit").click(function (e) {
            e.preventDefault();
            const form = $('#login-form');
            const email = $('input[name=email]').val();
            const password = $('input[name=password]').val();


            $.ajax({
                url: 'loginAction.php',
                method: 'POST',
                dataType: 'json',
                data: {email: email, password: password, action: "read"},
                success: function (res_data) {
                    // console.log(res_data);
                    // console.log(typeof res_data);
                    var returned_data = IS_JSON(res_data) ? jQuery.parseJSON(res_data) : res_data;
                    // console.log(returned_data);
                    // console.log(typeof returned_data);
                    if(typeof returned_data=='object'){
                        if(returned_data.response_type=='success'){
                            document.location = '/';
                        }else{
                            toastr.error(returned_data.response_message);
                        }
                    }else{
                            toastr.error('Wrong credentials!');
                    }
                },error: function(data) {
                    console.log('error:')
                    console.log(data.responseText)
                    toastr.error('Wrong credentials!');
                }
            });
        });


    })(jQuery);

</script>
</body>

</html>

