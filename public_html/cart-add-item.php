<?php
declare(strict_types=1);

// use Hlakioui\API\CmsApi;
use Hlakioui\DotEnv\DotEnv;
use Hlakioui\Shop\Cart;

require_once dirname(__DIR__) . '/vendor/autoload.php';
(new DotEnv(__DIR__ . '/../.env'))->load();

if (getenv('APP_APP_ENV') == 'dev') {
    ini_set('display_errors', 'true');
    ini_set('display_startup_errors', 'true');
    error_reporting(E_ALL);
}

session_start();
// $cmsApi = new CmsApi();
$trans = new \Hlakioui\Trans\Trans();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['__token'] == 'add_' . $_POST['id']) {
        $cart = new Cart();
        $pid = (int)$_POST['id'];
        $name = $_POST['name'] ?? '';
        $price = (float)$_POST['price'] ?? '';
        $qty = (int)$_POST['qty'];
        $location_id = isset($_POST['location_id']) ? (int)$_POST['location_id'] : false;
        $shelf_id = isset($_POST['shelf_id']) ? (int)$_POST['shelf_id'] : false;
        $best_before_date = isset($_POST['best_before_date']) ? $_POST['best_before_date'] : false;
        $stock = isset($_POST['stock']) ? (float)$_POST['stock'] : false;
        
        // $cmsApi->pr($location_id, 1);
        if($location_id===false || $shelf_id===false)
            exit(json_encode(['response_type'=>'error', 'response_message'=>$trans->getTrans('no stock available')]));

        $cart->addItem($pid, $qty, $name, $price, $location_id, $shelf_id, $best_before_date, $stock);
        exit(json_encode(['response_type'=>'success', 'response_message'=>$trans->getTrans('success')]));
    } else {
        exit(json_encode(['response_type'=>'error', 'response_message'=>$trans->getTrans('token error')]));
    }
} else {
    exit(json_encode(['response_type'=>'error', 'response_message'=>$trans->getTrans('error')]));
}