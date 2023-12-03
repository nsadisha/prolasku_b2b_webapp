<?php
declare(strict_types=1);

use Hlakioui\DotEnv\DotEnv;

require_once dirname(__DIR__) . '/vendor/autoload.php';
(new DotEnv(__DIR__ . '/../.env'))->load();


session_start();

if (isset($_POST))
{
    $language = $_POST['language'];
    $_SESSION['language'] = $language;
    echo 'ok';
}