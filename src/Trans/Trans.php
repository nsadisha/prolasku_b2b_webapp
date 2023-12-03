<?php

namespace Hlakioui\Trans;

use Hlakioui\API\CmsApi;

class Trans
{

    private $langArray;

    public function __construct()
    {
        $cmsApi = new CmsApi();
        $language = $cmsApi->getMainLang();
        if($language===false){
            $this->langArray = include(__DIR__ . '/../../locale/en_GB.php');
            return true;
        }
        $lang = $language['code'];
        if (file_exists(__DIR__ . '/../../locale/' . $lang . '.php')) {
            $this->langArray = include(__DIR__ . '/../../locale/'. $lang .'.php');
        } else {
            $this->langArray = include(__DIR__ . '/../../locale/en_GB.php');
        }
    }

    public function getTrans($key)
    {
        if (isset($this->langArray[$key])) {
            return $this->langArray[$key];
        } else {
            return $key;
        }
    }
    public function getLang($data=array(), $key=false)
    {
        if(empty($data)){
            return '';
        }
        if ($key && isset($data[$key])) {
            return $data[$key];
        } else {
            if(isset($data['fi'])){
                return $data['fi'];
            }
            return $data[key($data)];
        }
    }
}