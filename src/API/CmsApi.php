<?php

namespace Hlakioui\API;

use Curl\Curl;

class CmsApi
{
    private Curl $curl;
    private string $url;
    public $MainLangData = array();

    public function __construct()
    {
        $this->url = getenv('CMS_API_END_POINT');
        $this->curl = new Curl();
        $this->curl->setHeader('Authorization1', getenv('CMS_API_KEY'));
        $this->MainLangData = array(); 
    }

    public function login(string $username, string $password)
    {
        $options = array(
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 1,
            'email' => $username,
            'customer_password' => $password,
        );
        // $this->pr($options);
        return $this->fetch('get_customer', $options);;
    }

    public function fetch($call, array $options)
    {
        $this->curl->post($this->url . '/' . $call . '/', $options);
        // if($call=="get_customer") {$this->pr(($this->curl->rawResponse));die;}
        // if($call=="get_customer") {$this->pr(json_decode($this->curl->rawResponse));die;}
        // if($call=="get_orders") {$this->pr($this->curl);die;}
        if ($this->curl->error) {
            return $this->curl->errorCode . ': ' . $this->curl->errorMessage . "\n";
        } else {
            // if($call=="set_order") {$this->pr(json_decode($this->curl->response));die;}
            // if($call=="get_orders") {$this->pr(json_decode($this->curl->response));die;}
            return json_decode($this->curl->response, true);
        }
    }

    public function getProducts($opts = [])
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 21,
            'customer_id' => $_SESSION['user_id'],
        ];

        $options = array_merge($options, $opts);

        $result = $this->fetch('get_products', $options);
        // $this->pr($result);die;
        return $result['OUTPUT'];
    }

    public function getProductById($id)
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 1,
            'pid' => $id,
            'customer_id' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0,
        ];

        $result = $this->fetch('get_products', $options);
        return $result['OUTPUT'];
    }

    public function getOrders(int $month, int $year)
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'email' => $_SESSION['user'],
            'customer_password' => $_SESSION['password'],
            'customer_id' => $_SESSION['user_id'],
            'year' => $year,
            'month' => $month,
            'start' => 0,
            'limit' => 50,
        ];
        // $this->pr($options);

        $result = $this->fetch('get_orders', $options);
        return $result['OUTPUT'];
    }

    public function getOrder(int $id)
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'email' => $_SESSION['user'],
            'customer_password' => $_SESSION['password'],
            'start' => 0,
            'limit' => 50,
            'order_id' => $id,
            'customer_id' => $_SESSION['user_id'],
        ];

        $result = $this->fetch('get_order', $options);
        return $result['OUTPUT'];
    }

    public function getCustomer(int $id)
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'email' => $_SESSION['user'],
            'customer_password' => $_SESSION['password'],
            'start' => 0,
            'limit' => 50,
            'customer_id' => $id,
        ];

        $result = $this->fetch('get_customer', $options);
        return $result['OUTPUT'];
    }

    public function getCities()
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 50,
        ];

        $result = $this->fetch('get_cities', $options);
        return $result['OUTPUT'];
    }

    public function getCountries()
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 50,
        ];

        $result = $this->fetch('get_countries', $options);
        return $result['OUTPUT'];
    }

    public function setAddress(array $address)
    {
        $order = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'email' => $_SESSION['user'],
            'customer_password' => $_SESSION['password'],
            'start' => 0,
            'limit' => 50,
            'customer_id' => $_SESSION['user_id'],
            'no_vat' => '0',
            'sale_price_by_net_margin' => '0',
            'sale_price_by_net_margin_percentage' => '0',
            'ignore_customer_pricing' => '0',
            'order_date' => date('Y-m-d H:i:s'),
            'delivery_date' => date('Y-m-d H:i:s'),
            'discount' => '0',
            'paid_date' => '',
            'phone' => $address['phone'],
            'phone_full' => '+' . $address['phone_prefix'] . '' . $address['phone'],
            'phone_prefix' => $address['phone_prefix'],
            'admin_id' => getenv('CMS_API_ADMIN_ID'),
            'loading_employee_id' => '0',
            'loading_employee_name' => '',
            'delivery_employee_id' => '0',
            'delivery_employee_name' => '',
            'payer_details' => '',
            'payee_details' => '',
            'note' => '',
            'delivery_instructions' => '',
            'order_by' => $address['name'],
            'country_id' => $address['country_id'],
            'city_id' => $address['city_id'],
            'currency_rate' => '1',
            'currency_country_id' => '40',### TODO:: this must be changed to dynamic variable value from main > get_currencies() API call!
            'customer_language' => 'fi',
            'customer_language_id' => '1',
            'customer_discount' => '0',
            'calculate_line_pricing_internally' => '1',
            'status' => '1',
            'payment_status' => '1',
            'address' => $address['address'],
            'state' => $address['state'],
            'postal' => $address['postal'],
            'city_id' => $address['city_id'],
            'country_id' => $address['country_id'],
            'different_shipping_address' => $address['different_shipping_address'] ?? 0,
            'shipping_address' => $address['shipping_address'],
            // 'shipping_state' => $address['shipping_state'],
            'shipping_postal' => $address['shipping_postal'],
            'shipping_city_id' => $address['shipping_city_id'],
            'shipping_country_id' => $address['shipping_country_id'],



        ];

        $_main_lang = $this->getMainLang();
        // $this->pr($_main_lang, 1);
        $_vat_array = $this->getVat();
        $_vat_array_columns = array_column($_vat_array, 'vatId');
        $_locations_array = $this->getLocations();
        $_locations_array_columns = array_column($_locations_array, 'location_id');
        $_shelves_array = $this->getShelves();
        $_shelves_array_columns = array_column($_shelves_array, 'shelf_id');
            // $this->pr($_locations_array_columns);
            // $this->pr($_shelves_array_columns);
        // if ($address['different_shipping_address'] == 1) {
        //     $order['shipping_address'] = $address['shipping_address'];
        //     $order['shipping_state'] = $address['shipping_state'];
        //     $order['shipping_postal'] = $address['shipping_postal'];
        //     $order['shipping_city_id'] = $address['shipping_city_id'];
        //     $order['shipping_country_id'] = $address['shipping_country_id'];
        // } else {
        //     $order['shipping_address'] = $address['address'];
        //     $order['shipping_state'] = $address['state'];
        //     $order['shipping_postal'] = $address['postal'];
        //     $order['shipping_city_id'] = $address['city_id'];
        //     $order['shipping_country_id'] = $address['country_id'];
        // }

        $i = 0;
        foreach ($_SESSION['shopping_cart'] as $item) {
            // $cmsApi->pr($item);
            $product = $this->getProductById($item['id']);
            $product = $product[key($product)];
            $_vat_key = array_search($product['vat'], $_vat_array_columns);
            $_vat_buy_key = array_search($product['vat_buy'], $_vat_array_columns);
            
            $_location_key = isset($item['location_id']) ? array_search($item['location_id'], $_locations_array_columns) : 0;
            $_location_name = (isset($_locations_array[$_location_key]['name']) ? $_locations_array[$_location_key]['name'] : '');
            
            $_shelf_key = isset($item['shelf_id']) ? array_search($item['shelf_id'], $_shelves_array_columns) : 0;
            $_shelf_name = (isset($_shelves_array[$_shelf_key]['shelf_name']) ? $_shelves_array[$_shelf_key]['shelf_name'] : '');
            // $this->pr($this->deSanitize($_shelf_name[$_main_lang['code']]), 1);
            $orderItem = [
                'order_lines[' . $i . '][line_type]' => '0',
                'order_lines[' . $i . '][number]' => $i+1,
                'order_lines[' . $i . '][product_name]' => $product['product_name'],
                'order_lines[' . $i . '][pid]' => $product['pid'],
                'order_lines[' . $i . '][prdNumber]' => $product['prdNumber'],
                'order_lines[' . $i . '][stock_type_id]' => $product['stock_type_id'],
                'order_lines[' . $i . '][stock_type_name]' => ['en_gb'=>'pcs','fi'=>'kpl'],
                'order_lines[' . $i . '][stock_available]' => '0',
                'order_lines[' . $i . '][vat_id]' => $product['vat'],
                'order_lines[' . $i . '][vat_percent]' => (isset($_vat_array[$_vat_key]['vat_name']) ? $_vat_array[$_vat_key]['vat_name'] : 0),
                'order_lines[' . $i . '][unit_price]' => $product['price_net_after_discount'],
                'order_lines[' . $i . '][unit_price_buy]' => $product['price_gross_after_discount'],
                'order_lines[' . $i . '][customer_pricing_ignored]' => '0',
                'order_lines[' . $i . '][vat_id_buy]' => $product['vat_buy'],
                'order_lines[' . $i . '][vat_percent_buy]' => (isset($_vat_array[$_vat_buy_key]['vat_name']) ? $_vat_array[$_vat_buy_key]['vat_name'] : 0),
                'order_lines[' . $i . '][quantity]' => $item['qty'],
                'order_lines[' . $i . '][weight]' => $product['weight'],
                'order_lines[' . $i . '][weight_type]' => $product['weight_type'],
                'order_lines[' . $i . '][location]' => $_location_name.' '.(isset($_shelf_name[$_main_lang['code']]) ? $_shelf_name[$_main_lang['code']] : ''),
                'order_lines[' . $i . '][location_id]' => isset($item['location_id']) ? $item['location_id'].'-'.$item['shelf_id'] : '0-0', ### location_id-shelf_id
                'order_lines[' . $i . '][supplier_id]' => $product['supplier_id'],
                'order_lines[' . $i . '][best_before_date]' => isset($item['best_before_date']) ? $item['best_before_date'] : false,
                'order_lines[' . $i . '][discount]' => $product['discount'],
                'order_lines[' . $i . '][barcode]' => $product['barcode'],
                'order_lines[' . $i . '][barcode_id]' => $product['barcode_id'],
                'order_lines[' . $i . '][barcode_type]' => '',
                'order_lines[' . $i . '][line_note]' => '',
                'order_lines[' . $i . '][category_name]' => '',
                'order_lines[' . $i . '][customer_pricing_exist]' => '',
                'order_lines[' . $i . '][stock_available_now]' => $item['stock'] ?? 0,
                'order_lines[' . $i . '][stock_alert_qty]' => $product['stock_alert_qty'],
                'order_lines[' . $i . '][stock_alert_bbd]' => $product['stock_alert_bbd'],
                'order_lines[' . $i . '][relation_qty_type]' => $product['relation_qty_type'],
                'order_lines[' . $i . '][box_qty]' => $product['box_qty'],
                'order_lines[' . $i . '][pallet_qty]' => $product['pallet_qty'],
                'order_lines[' . $i . '][pallet_qty_type]' => $product['pallet_qty_type'],
                'order_lines[' . $i . '][customer_id]' => $_SESSION['user_id'],
                'order_lines[' . $i . '][ignore_customer_pricing]' => '0',
                'order_lines[' . $i . '][symbol]' => '€',
                'order_lines[' . $i . '][stock_type_measure]' => $product['stock_type_measure'],
            ];

            $order = array_merge($orderItem, $order);
            $i++;
        }

        $_SESSION['order'] = $order;
        // $this->pr($order);die;
    }

    public function setShipping(array $data)
    {
        $_SESSION['order']['shipping_method'] = $data['shipping'];
    }

    public function setPayment(array $data)
    {
        $_SESSION['order']['payment_method'] = $data['payment'];
    }

    public function setSendOrder()
    {
        $options = $_SESSION['order'];

        $result = $this->fetch('set_order', $options);
        // $this->pr('options:');
        // $this->pr($options);
        // $this->pr('result:');
        // $this->pr('result:');
        // $this->pr($result);die;
        return $result['OUTPUT'];
    }


    public function getCurrencies()
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 50,
        ];

        $result = $this->fetch('get_currencies', $options);
        return $result['OUTPUT'];
    }


    public function getLanguages()
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 50,
        ];

        $result = $this->fetch('get_languages', $options);
        return $result['OUTPUT'];
    }

    public function getCategories($cids=array())
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 50,
        ];

        if(!empty($cids)){
            $options['IN'] = $cids;
        }

        $result = $this->fetch('get_categories', $options);
        return $result['OUTPUT'];
    }

    public function getBrands()
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 50,
        ];

        $result = $this->fetch('get_brands', $options);
        return $result['OUTPUT'];
    }

    public function getShippingMethods()
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 50,
        ];

        $result = $this->fetch('get_shipping_methods', $options);

        $tmp = array();
        $allowed_shoippings = array('courier_delivery', 'pickup');
        // $this->pr($result['OUTPUT']);
        if(isset($result['OUTPUT']) && $result['OUTPUT'])
        foreach ($result['OUTPUT'] as $key => $value) {
            if(in_array($value['title'], $allowed_shoippings))
                $tmp[$key] = $value;
        }
        // $this->pr($tmp);
        return $tmp;
    }

    public function getPaymentMethods()
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 50,
        ];

        $result = $this->fetch('get_payment_methods', $options);
        return $result['OUTPUT'];
    }

    public function getLocations($id=false)
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 50,
            
        ];
        if($id && is_array($id)) {
            $options['IN'] = $id; 
        }
        if($id && !is_array($id)) {
            $options['IN'] = [$id]; 
        }

        $result = $this->fetch('get_locations', $options);
        return $result['OUTPUT'];
    }

    public function getStock_types($id=false)
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 50,
            
        ];
        if($id && is_array($id)) {
            $options['IN'] = $id; 
        }
        if($id && !is_array($id)) {
            $options['IN'] = [$id]; 
        }

        $result = $this->fetch('get_stock_types', $options);
        return $result['OUTPUT'];
    }
    
    public function getShelves($id=false)
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 50,
            
        ];
        if($id && is_array($id)) {
            $options['IN'] = $id; 
        }
        if($id && !is_array($id)) {
            $options['IN'] = [$id]; 
        }

        $result = $this->fetch('get_shelves', $options);
        return $result['OUTPUT'];
    }

    public function getVatById($id)
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 1,
            'IN' => [$id],
        ];

        $result = $this->fetch('get_taxes', $options);
        return $result['OUTPUT'];
    }

    public function getVat()
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'start' => 0,
            'limit' => 50,
        ];

        $result = $this->fetch('get_taxes', $options);
        return $result['OUTPUT'];
    }

    public function getMainCurrency()
    {
        foreach ($this->getCurrencies() as $currency) {
            if ($currency['main'] == 1) {
                return $currency['currency_symbol'];
            }
        }
    }

    public function getMainLang()
    {

        $gotMainLang = false;
        if(!empty($this->MainLangData) ){
            // $this->pr('gotMainLang is not empty');
            $gotMainLang = true;
            return $this->saveMainLang($this->MainLangData);
        }
        if(isset($_SESSION['MainLangData']) && !empty($_SESSION['MainLangData'])) {
            // $this->pr('SESSION gotMainLang is not empty');
            $gotMainLang = true;
            return $this->saveMainLang($_SESSION['MainLangData']);
        }

        $all_langs = $this->getLanguages();
        if($gotMainLang == false && isset($_SESSION['user_id'])){
            $customer = $this->getCustomer($_SESSION['user_id']);
            // $this->pr($customer);
            if(isset($customer['response_type']) && $customer['response_type']=='error'){
                ### $gotMainLang = false;
            }else{
                foreach ($all_langs as $language) {
                    if ($language['id'] == $customer['language_id']) {
                        $gotMainLang = true;

                        return $this->saveMainLang($language);
                    }
                }        
            }
        }

        if(!$gotMainLang){// at the login
            // $this->pr($all_langs);
            foreach ($all_langs as $language) {
                if ($language['default'] == 1) {
                    // $this->pr($language);
                    return $this->saveMainLang($language);
                }
            }        
        }


    }
    public function setLangDataByid(int $id){
        $all_langs = $this->getLanguages();
        foreach ($all_langs as $language) {
            if ($language['id'] == $id) {
                $gotMainLang = true;
                return $this->saveMainLang($language);
            }
        }        
    }
    public function saveMainLang($MainLangData)
    {
        $_SESSION['MainLangData'] = $MainLangData;
        return $this->MainLangData = $MainLangData;
    }

    public function setCustomerLang(int $id)
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'email' => $_SESSION['user'],
            'customer_password' => $_SESSION['password'],
            'customer_id' => $_SESSION['user_id'],
            'start' => 0,
            'limit' => 50,
            'language_id' => $id,
        ];

        $this->setLangDataByid($id);
        $result = $this->fetch('set_customer_update_profile', $options);

        return $result['OUTPUT'];
    }

    public function updateCustomerAddress(array $customer)
    {
        $options = [
            'username' => getenv('CMS_API_USERNAME'),
            'password' => getenv('CMS_API_PASSWORD'),
            'account' => getenv('CMS_API_ACCOUNT_ID'),
            'email' => $_SESSION['user'],
            'customer_password' => $_SESSION['password'],
            'customer_id' => $_SESSION['user_id'],
            'start' => 0,
            'limit' => 50,
            'language_id' => $_SESSION['language']['id'],
        ];
        $customer['different_shipping_address'] = isset($customer['different_shipping_address']) && $customer['different_shipping_address']=='on' ? 1 : 0;
        // $this->pr($customer, 1);die;
        $options = array_merge($options, $customer);
        // $this->pr($options, 1);die;
        $result = $this->fetch('set_customer_update_profile', $options);
        // $this->pr($result, 1);die;

        return $result['OUTPUT'];
    }

    public function order_status_array(){
        return $ORDER_STATUS_ARRAY = array(
            1=>array(
                'title'=>'draft',
                'icon'=>'fa fa-list-alt',
                'color'=> 'danger',
            ), 
            5=>array(
                'title'=>'status_accepted',
                'icon'=>'fa fa-check-circle',
                'color'=>'success',
            ),

            10=>array(
                'title'=>'preparing_for_shipment',
                'icon'=>'fa fa-hourglass-half',
                'color'=>'success',
            ), 
            20=>array(
                'title'=>'prepared_for_shipment',
                'icon'=>'fa fa-get-pocket',
                'color'=>'primary',
            ), 
            30=>array(
                'title'=>'scheduled_for_shipping',
                'icon'=>'fa fa-calendar-check-o',
                'color'=>'primary',
            ), 
            40=>array(
                'title'=>'on_shipping_route',
                'icon'=>'fa fa-truck',
                'color'=>'primary',
            ), 
            50=>array(
                'title'=>'shipped',
                'icon'=>'fa fa-truck',
                'color'=>'primary',
            ), 

            110=>array(
                'title'=>'preparing_for_delivery',
                'icon'=>'fa fa-hourglass-half',
                'color'=>'success',
            ), 
            120=>array(
                'title'=>'prepared_for_delivery',
                'icon'=>'fa fa-check-square-o',
                'color'=>'primary',
            ), 
            130=>array(
                'title'=>'scheduled_for_delivery',
                'icon'=>'fa fa-calendar-check-o',
                'color'=>'primary',
            ), 
            140=>array(
                'title'=>'on_delivery_route',
                'icon'=>'fa fa-truck',
                'color'=>'primary',
            ), 
            150=>array(
                'title'=>'delivered',
                'icon'=>'fa fa-handshake-o',
                'color'=>'primary',
            ), 


            180=>array(
                'title'=>'ready_to_pickup',
                'icon'=>'fa fa-check-square-o',
                'color'=>'primary',
            ), 
            190=>array(
                'title'=>'pickedup',
                'icon'=>'fa fa-handshake-o',
                'color'=>'primary',
            ), 

            
            -1=>array(
                'title'=>'cancelled',
                'icon'=>'fa fa-calendar-times-o',
                'color'=>'danger',
            ),
        );        
    }

    public function order_status_data($status=1){
        $_status_array = $this->order_status_array();
        foreach ($_status_array as $key => $value) {
            if($key==$status){
                return $value;
                break;
            }
        }
    }

    // usage
    // 1. Return type of an object!
    // 2. Return boolean if the type (second argument) passed to the function it will return true or false boolean!
    public function _check_type($obj=false){
        $type = func_num_args()>1 ? func_get_arg(1) : false;
        if($obj):
            $_this_type = gettype($obj);
            if($type):
                if($_this_type==$type):
                    return true;
                else:
                    return false;
                endif;
            endif;
            return $_this_type;
        endif;
    }

    public function deSanitize($string, $option=FALSE){
        ### sometimes $option is passed but it is ot correct. example passed string but array given!
        ### to fix any errors we double check that!
        $_this_type = self::_check_type($string);
        if(strtolower($_this_type)!=strtolower($option)){
            $option = $_this_type;
        }
        switch($option):
            case 'text':
            case 'string':
                $string = !empty($string) ? (urldecode(trim($string))) : $string;
            break;
            case 'bigint':
            case 'int':
            case 'integer':
                ### in some php 32 bit versions of php if max numbers exceeds PHP_INT_MAX then php changes the integer to 2147483647
                ### to avoid this we will check the PHP_INT_MAX size and act accordingly!
                if((int)$string < PHP_INT_MAX){
                    return $string = (int)$string;
                }else{
                    return $string = number_format((double)$string, 0, '', '');
                }
            break;
            case 'float':
                return $string = (float)$string;
            break;
            case 'double':
                return $string = (double)$string;
            break;
            default:
                if($_this_type=='array' || $_this_type=='object'):
                    return $string;
                else:
                    $string = !empty($string) ? urldecode(trim($string)) : $string;
                endif;
        endswitch;
        // $string = my_nl2br(htmlspecialchars_decode(trim($string)));
        $string = preg_replace('#<br\s*/?>#i', "\n", $string);
        $string = htmlspecialchars_decode(trim($string));
        // $string = urldecode(html_entity_decode($string, ENT_QUOTES, 'UTF-8'));
        // $string = htmlspecialchars_decode(trim($string), ENT_QUOTES);
        // $string = stripslashes(trim($string));
        $string = trim($string);
        $string = ltrim($string);
        return $string!='' ? trim($string) : $string;
    }

    public function populateCartStockInputs($product){
        $str = '';
        $found_default_location = false;
        $_stock_locations = isset($product['stock_data']) ? $product['stock_data'] : false;
        if($_stock_locations){
            foreach ($_stock_locations as $stk => $stv) {
                // $cmsApi->pr($stv);
                if($stv['default_location']==1){
                    $found_default_location = true;
                    $str .= '<input type="hidden" name="location_id" value="'.$stv["location_id"].'">';
                    $str .= '<input type="hidden" name="shelf_id" value="'.$stv["shelf_id"].'">';
                    $str .= '<input type="hidden" name="best_before_date" value="'.$stv["best_before_date"].'">';
                    $str .= '<input type="hidden" name="stock" value="'.$stv["stock"].'">';
                }
            }
        }
        if(!$found_default_location){
            if(isset($_stock_locations[0]['location_id'])){
                $stv = $_stock_locations[0];
                    $str .= '<input type="hidden" name="location_id" value="'.$stv["location_id"].'">';
                    $str .= '<input type="hidden" name="shelf_id" value="'.$stv["shelf_id"].'">';
                    $str .= '<input type="hidden" name="best_before_date" value="'.$stv["best_before_date"].'">';
                    $str .= '<input type="hidden" name="stock" value="'.$stv["stock"].'">';
            }else{
                    $str .= '<input type="hidden" name="location_id" value="">';
                    $str .= '<input type="hidden" name="shelf_id" value="">';
                    $str .= '<input type="hidden" name="best_before_date" value="">';
                    $str .= '<input type="hidden" name="stock" value="">';
            }
        }        
        return $str;      
    } 
    public function populateProductStock($product){
        global $trans;
        if($trans == null)  
            $trans = new \Hlakioui\Trans\Trans();
        $str = '';
        $_locations_array = $this->getLocations();
        $_locations_array_columns = array_column($_locations_array, 'location_id');

        $found_default_location = false;
        $_stock_locations = isset($product['stock_data']) ? $product['stock_data'] : false;
        if($_stock_locations){
            foreach ($_stock_locations as $stk => $stv) {
                $status_color = $stv['stock'] > 0 
                                    ? 'in' 
                                    : ($stv['stock'] < $product['stock_alert_qty'] 
                                        ? 'alert'
                                        : 'out');

                $found_default_location = true;
                $_location_key = array_search($stv['location_id'], $_locations_array_columns);
                $_location_name = (isset($_locations_array[$_location_key]['name']) ? $_locations_array[$_location_key]['name'] : '');
                // $cmsApi->pr($stv);
                $str .= '<div class="relative p-l-sm">';
                $str .= '<div class="inline-block p-r-lg stock_status '.$status_color.'">'.$_location_name.':</div>';
                $str .= '<div class="inline-block">'.$stv["stock"].'  /'.$this->get_stock_location_name($product['stock_type_id']).'</div>';
                $str .= '</div>';
            }
        }
        if(!$found_default_location){
            $str .= '<span class="">'.$trans->getTrans('no stock available').'"</span>';
        } 
        if(!empty($str)) $str = '<div class="bold m-t-sm p-t-sm">'.$trans->getTrans('availibility').':</div>' . $str;

        return $str;      
    } 
    public function get_stock_location_name($stock_type_id){
        global $trans;
        if($trans == null)  
            $trans = new \Hlakioui\Trans\Trans();
        $_stock_type_array = $this->getStock_types();
        $_stock_type_array_columns = array_column($_stock_type_array, 'stock_type_id');
        $_stock_type_key = array_search($stock_type_id, $_stock_type_array_columns);
        $_stock_type_name = (isset($_stock_type_array[$_stock_type_key]['stock_type_name']) ? $_stock_type_array[$_stock_type_key]['stock_type_name'] : '');
        return $trans->getLang($_stock_type_name, $_SESSION['language']['code']);
    }

    //XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX  JUST FOR DEBUGGING
    public function pr($data, $_exit=false){
        echo "<xmp style='text-align:left;'>";
        print_r($data);
        echo "</xmp>";
        if($_exit) exit;
    }

}