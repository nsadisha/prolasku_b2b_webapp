<?php
declare(strict_types=1);

use Hlakioui\API\CmsApi;
use Hlakioui\DotEnv\DotEnv;

require_once dirname(__DIR__) . '/vendor/autoload.php';
(new DotEnv(__DIR__ . '/../.env'))->load();


session_start();

if (isset($_POST)) {
    $langID = $_POST['language'];
    $cmsApi = new CmsApi();
    $result = $cmsApi->setCustomerLang((int)$langID);
    // $cmsApi->pr($result);
    // die;
    echo 'ok';
}