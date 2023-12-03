<?php
declare(strict_types=1);

use Hlakioui\DotEnv\DotEnv;

require_once dirname(__DIR__) . '/vendor/autoload.php';
(new DotEnv(__DIR__ . '/../.env'))->load();


session_start();
$trans = new \Hlakioui\Trans\Trans();
if (isset($_POST))
{
    $cmsApi = new \Hlakioui\API\CmsApi();
    $cur = $cmsApi->getMainCurrency();
    $language = $cmsApi->getMainLang();
    $lang = $language['code'];

    $page = $_POST['page'] ?? 0;
    $search = $_POST['search'];
    $cats = $_POST['cats'];
    $options = [];

    if ($page > 0) {
        $options['start'] = $page * 21;
    }


    if (isset($_POST['search'])) {
        $options['product_name'] = $search;
    }

    $categories = [];
    if (isset($_POST['cats'])) {
        $cats = json_decode($_POST['cats'], true);
        foreach ($cats as $cat)
        {
            $categories[] = $cat[0];
        }
        $options['cid'] = $categories;
    }

    $brands = [];
    if (isset($_POST['bids'])) {
        $bids = json_decode($_POST['bids'], true);
        foreach ($bids as $bid) {
            $brands[] = $bid[0];
        }
        if (!empty($brands)) {
            $options['bid'] = $brands;
        }
    }

    $products = $cmsApi->getProducts($options);

    $output = '';
    $img = '<img src="../assets/images/Image_COMMING_SOON-NEW-PROLASKU-1024.png" alt="Vegetables" width="270" height="270" class="product-thumbnail">';
    
    include('pages/product_blocks.php');

    echo $output;
}