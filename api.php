<?php

namespace API\Client;

/**
 * 
 */
class API
{
    const URL            = "https://quantum.atlasquantum.com/api/";

    public  $msg;
    private $access_token = null;
    private $refresh_token = null;
    private $http_user_agent = "";

    public function __construct($API_KEY, $API_SECRET)
    {
        $this->connect($API_KEY, $API_SECRET);
    }
    
    private function connect($API_KEY, $API_SECRET){ 

        //$this->http_user_agent = (isset($_SERVER['HTTP_USER_AGENT']))?$_SERVER['HTTP_USER_AGENT']:hash('sha512', rand().date("YmdHis"));

        $this->http_user_agent = "Mozilla/5.0 (Macintosh; Intel Mac OS X x.y; rv:42.0) Gecko/20100101 Firefox/42.0";

        $curl = curl_init();

        $form = array("grant_type"   => "client_credentials",
                      "api_key"      => $API_KEY,
                      "api_secret"   => $API_SECRET);

        $form = json_encode($form);

        curl_setopt_array($curl, array(
          CURLOPT_URL => self::URL."oauth/token",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_USERAGENT=>$this->http_user_agent,
          CURLOPT_POSTFIELDS =>$form,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "cache-control: no-cache"
          ),
        ));



        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return "cURL Error #:" . $err;
        } 
        $response = json_decode($response);

        $this->access_token  = (isset($response->access_token))?$response->access_token:null;
        $this->refresh_token = (isset($response->refresh_token))?$response->refresh_token:null;
        
        if(isset($response->access_token))
          return true;

        return false;

    }

    public function volume(){ 

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => self::URL."volume",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 10,
          CURLOPT_USERAGENT=>$this->http_user_agent,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          ),
        ));


        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          return "cURL Error #:" . $err;
        } 

        return json_decode($response);

    }


    public function markets(){ 

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => self::URL."markets",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 10,
          CURLOPT_USERAGENT=>$this->http_user_agent,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          ),
        ));


        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          return "cURL Error #:" . $err;
        } 

        return json_decode($response);

    }


    public function trades($pair){ 
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => self::URL."trades/".$pair,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 10,
          CURLOPT_USERAGENT=>$this->http_user_agent,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          ),
        ));


        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          return "cURL Error #:" . $err;
        } 

        return json_decode($response);

    }

    public function ticker($pair){ 
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => self::URL."ticker/".$pair,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 10,
          CURLOPT_USERAGENT=>$this->http_user_agent,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          ),
        ));


        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          return "cURL Error #:" . $err;
        } 

        return json_decode($response);

    }

    
    public function orderbook($pair){ 
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => self::URL."orderbook/".$pair,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 10,
          CURLOPT_USERAGENT=>$this->http_user_agent,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
          ),
        ));


        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          return "cURL Error #:" . $err;
        } 

        return json_decode($response);

    }

   



    public function newOrder($type, $pair, $executionType, $unitPrice, $quantity){ 

        $form = array("symbol"      => $pair,
                       "quantity"   => $quantity,
                       "price"      => $unitPrice,
                       "type"       => $executionType
                      );

        $form = json_encode($form);
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => self::URL."".$type,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 5,
          CURLOPT_USERAGENT=>$this->http_user_agent,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $form,
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$this->access_token,
            "cache-control: no-cache"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          return "cURL Error #:" . $err;
        } 

        return json_decode($response);
        
    }



    public function cancelOrder($ID){ 

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => self::URL."cancel/".$ID,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 5,
          CURLOPT_USERAGENT=>$this->http_user_agent,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "DELETE",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$this->access_token,
            "cache-control: no-cache"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          return "cURL Error #:" . $err;
        } 

        return json_decode($response);
    }


    public function balance($coin){ 

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => self::URL."balance/".$coin,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 5,
          CURLOPT_USERAGENT=>$this->http_user_agent,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$this->access_token,
            "cache-control: no-cache"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          return "cURL Error #:" . $err;
        } 

        return json_decode($response);
    }


    public function orders($pair){ 

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => self::URL."orders/".$pair,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 5,
          CURLOPT_USERAGENT=>$this->http_user_agent,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer ".$this->access_token,
            "cache-control: no-cache"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          return "cURL Error #:" . $err;
        } 

        return json_decode($response);
    }
}