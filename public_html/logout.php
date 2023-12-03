<?php
declare(strict_types=1);

use Hlakioui\API\CmsApi;
use Hlakioui\DotEnv\DotEnv;

require_once dirname(__DIR__) . '/vendor/autoload.php';
(new DotEnv(__DIR__ . '/../.env'))->load();


session_start();

if (isset($_POST['logout']) && $_POST['logout']==1) {
	if(isset($_SESSION['logIn'])) unset($_SESSION['logIn']);
	if(isset($_SESSION['user'])) unset($_SESSION['user']);
	if(isset($_SESSION['user_id'])) unset($_SESSION['user_id']);
	if(isset($_SESSION['password'])) unset($_SESSION['password']);
	if(isset($_SESSION['currency'])) unset($_SESSION['currency']);
	if(isset($_SESSION['language'])) unset($_SESSION['language']);
	if(isset($_SESSION['order'])) unset($_SESSION['order']);
    echo 'ok';
}