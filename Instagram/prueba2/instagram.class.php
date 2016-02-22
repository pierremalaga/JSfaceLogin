<?php 

class Instagram {

const REQUEST_TOKEN_URL="https://api.instagram.com/oauth/authorize";
const ACCESS_TOKEN_URL = 'https://api.instagram.com/oauth/access_token';
const API_URL = 'https://api.instagram.com/v1/';
// clave de acceso
private $_apikey;
define("client_id", '41f65a5c684048bca797dbf0775c9ec7');
// constraseña de acceso
private $_apisecret;
define("ClientSECRET", '95647e6ef2a445ff92e8b27c82bf8da6');
// url de callback
private $_callbackurl;
define("redirect_uri", 'http://localhost:80/Instagram/instagram.php');
private $_access_token;
// el tipo de acceso server-side (code) o client-side (token)
private $_codeType;

// Constructor
public function __construct($apiKey, $apiSecret, $callBackUrl,$codeType) {
$this->setApiKey($apiKey);
$this->setApiSecret($apiSecret);
$this->setCallBackUrl($callBackUrl);
$this->setCodeType($codeType);
}

// retorna el link a la pagina para loggearnos en Instagram
public function getLoginURL(){
return self::REQUEST_TOKEN_URL.'?client_id='.$this->getApiKey().'&redirect_uri='.$this->getCallBackUrl().'&response_type='.$this->getCodeType();
}

// busca las fotos recientes subidas por el
public function getUserMedia($userId, $max = 0) {
return $this->_oAuthCall('users/'.$userId.'/media/recent', true, array('count' => $max));
}

// obtenemos el access_token para realizar las operaciones
public function getAccess_Token($code){
$data = array(
'grant_type' => 'authorization_code',
'client_id' => $this->getApiKey(),
'client_secret' => $this->getApiSecret(),
'redirect_uri' => $this->getCallBackUrl(),
'code' => $code
);
$result= $this->oAuthCall($data);
$this->setAccessToken($result->access_token);
return $result;
}

// metodo para realizar las llamadas a los servicios de instagram
// algunos no es necesario estar loggeado
private function _oAuthCall($url,$requireAuth=false,$parametros = null){

if (false === $requireAuth) {
// Si no se necesita autenticacion pasamos la clave de acceso
$metodoAuth = '?client_id='.$this->getApiKey();
} else {
// si necesita autenticacion
if (true === isset($this->_access_token)) {
$metodoAuth = '?access_token='.$this->getAccessToken();
} else {
throw new Exception("Error: $url - Se necesita autenticacion.");
}
}

if (isset($parametros) && is_array($parametros)) {
$parametros = '&'.http_build_query($parametros);
} else {
$parametros = "";
}

$urlFinal = self::API_URL.$url.$metodoAuth.$parametros;

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $urlFinal);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 8);

$json= curl_exec($curl);
curl_close($curl);
return json_decode($json);
}
// Metodo para realizar la peticion HTTP del Accesstoken y variables post
private function oAuthCall($arrayData) {
$host = self::ACCESS_TOKEN_URL;

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $host);
curl_setopt($curl, CURLOPT_POST, count($arrayData));
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($arrayData));
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$json = curl_exec($curl);
curl_close($curl);

return json_decode($json);
}

// Metodos set y get
public function setApiKey($apiKey) {

$this->_apikey = $apiKey;
}

public function getApiKey() {
return $this->_apikey;
}

public function setApiSecret($apiSecret) {
$this->_apisecret = $apiSecret;
}

public function getApiSecret() {
return $this->_apisecret;
}

public function setCallBackUrl($callbackurl) {
$this->_callbackurl = $callbackurl;
}

public function getCallBackUrl() {
return $this->_callbackurl;
}

public function setCodeType($codeType) {
$this->_codeType = $codeType;
}

public function getCodeType() {
return $this->_codeType;
}

public function setAccessToken($access_token) {
$this->_access_token = $access_token;
}

public function getAccessToken() {
return $this->_access_token;
}

}
?>