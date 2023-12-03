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

if ($_POST['action'] == 'read') {

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $cmsApi = new CmsApi();
    $response = $cmsApi->login($email, $password);

    $trans = new \Hlakioui\Trans\Trans();


    if (isset($response['OUTPUT']['response_type']) && $response['OUTPUT']['response_type'] == 'error')
    {
        // $cmsApi->pr($response['OUTPUT']['message']);
        // $cmsApi->pr($trans->getTrans($response['OUTPUT']['message']));
        exit(json_encode(array("response_type"=>"error", "response_message"=>(isset($response['OUTPUT']['message']) ? $trans->getTrans($response['OUTPUT']['message']) : 'invalid credential!')) ));
    } 
    elseif (isset($response['OUTPUT']['response_type']) && $response['OUTPUT']['response_type'] == 'success')
    {
        $_SESSION['logIn'] = true;
        $_SESSION['user'] = $response['OUTPUT']['email'];
        $_SESSION['user_id'] = $response['OUTPUT']['customer_id'];
        $_SESSION['password'] = $password;
        $_SESSION['currency'] = $cmsApi->getMainCurrency();
        $_SESSION['language'] = $cmsApi->getMainLang();
        exit(json_encode(array("response_type"=>"success", "response_message"=>(isset($response['OUTPUT']['message']) ? $trans->getTrans($response['OUTPUT']['message']) : 'logged in successfully!')) ));
    } else {
        // $cmsApi->pr($response);
        exit(json_encode(array("response_type"=>"error", "response_message"=>(isset($response['OUTPUT']) ? $response['OUTPUT'] : 'somethings went wrong!')) ));
    }
}