<?php
declare(strict_types=1);

use Hlakioui\DotEnv\DotEnv;
use Hlakioui\Shop\Cart;

require_once dirname(__DIR__) . '/vendor/autoload.php';
(new DotEnv(__DIR__ . '/../.env'))->load();

session_start();
$trans = new \Hlakioui\Trans\Trans();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['__token'] == 'add_' . $_POST['id']) {
        $cart = new Cart();
        $pid = (int)$_POST['id'];
        $name = $_POST['name'] ?? '';
        $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
        $qty = (int)$_POST['qty'];
        $cart->updateDate($pid, $qty, $name, $price);
        
        exit(json_encode(['response_type'=>'success', 'response_message'=>$trans->getTrans('success')]));
    }
} else {
        exit(json_encode(['response_type'=>'error', 'response_message'=>$trans->getTrans('error')]));
}
