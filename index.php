<?
require_once('crest.php');
$filename = "result.txt";
$handler = fopen($filename, "a");
//*************************
if($_POST['name']){
	$name = $_POST['name'];
}elseif($_POST['Name']){
	$name = $_POST['Name'];
}else{
	$name = $_POST['NAME'];
}

if($_POST['phone']){
	$phone = $_POST['phone'];
}elseif($_POST['Phone']){
	$phone = $_POST['Phone'];
}else{
	$phone = $_POST['PHONE'];
}

if($_POST['email']){
	$mail = $_POST['email'];
}elseif($_POST['Email']){
	$mail = $_POST['Email'];
}else{
	$mail = $_POST['EMAIL'];
}
//*************************
$DLYAPRODAJ = $_POST['DLYAPRODAJ'];
$ORGANIZATION = $_POST['ORGANIZATION'];
$KOMMENTARII = $_POST['KOMMENTARII'];
$SELECTBOX = $_POST['SELECTBOX'];
$TYPEOFMEDIA = $_POST['TYPEOFMEDIA'];
$PRODUCT = $_POST['PRODUCT'];
$INPUT = $_POST['INPUT'];
$REGIONCITY = $_POST['REGIONCITY'];
$COMMENTS = $_POST['COMMENTS'];
$STATUSDESCRIP = $_POST['STATUSDESCRIP'];
$UFCRMDETAIL2 = $_POST['UFCRMDETAIL2'];
$POST = $_POST['POST'];
$KAKIERESHENIY = $_POST['KAKIERESHENIY'];
$GDEVIUZNALION = $_POST['GDEVIUZNALION'];
$NASKOLKOMATER = $_POST['NASKOLKOMATER'];
$NASKOLKOVAMIN = $_POST['NASKOLKOVAMIN'];
$GOTOVILIVIUCH = $_POST['GOTOVILIVIUCH'];
$NAZVANIEORGAN = $_POST['NAZVANIEORGAN'];
$OSTROVNAVIBOR = $_POST['OSTROVNAVIBOR'];
$RASSKAZHITEOT = $_POST['RASSKAZHITEOT'];
$BYUDZHETVKOTO = $_POST['BYUDZHETVKOTO'];
$FORMNAME = $_POST['FORMNAME'];
$COMMENTS2 = $_POST['COMMENTS2'];



//*************************
$crm = $_POST['UF_CRM_DETAIL'];
$city = $_POST['RegionCity'];
$formname = $_POST['formname'];
$tranid = $_POST['tranid'];
$cookies = $_POST['COOKIES'];
$sourseID = 27;
$refferer = $_SERVER['HTTP_REFERER'];

$title = "Заявка(".$formname.")";

$s = urldecode($cookies);
fwrite($handler,$refferer.PHP_EOL);
$arr = explode("TILDAUTM=", $s);
$arr = explode("|||", $arr[1]);
array_pop($arr);
$utm = array();
foreach($arr as $a){
	$elem = explode("=", $a);
	$utm[$elem[0]] = $elem[1];
}
// put an example below
$result = CRest::call(
   'crm.lead.add',
   [
      	'fields' =>[
      	'TITLE' => $title,
      	'NAME' => $name,
      	"PHONE" => array(array("VALUE"=>$phone, "VALUE_TYPE"=>"WORK" )),
    	"EMAIL" => array(array("VALUE"=>$mail, "VALUE_TYPE"=>"WORK" )),
		'SOURCE_ID' => $sourseID,
		'SOURCE_DESCRIPTION' => $refferer,
		'UF_CRM_TRANID' => $tranid,
		'UF_CRM_COOKIES' => $cookies,
		'UTM_CAMPAIGN' => $utm['utm_campaign'],
        'UTM_CONTENT' => $utm['utm_content'],
        'UTM_MEDIUM' => $utm['utm_medium'],
        'UTM_SOURCE' => $utm['utm_source'],
        'UTM_TERM' => $utm['utm_term'],
		'UF_CRM_DLYAPRODAJ' => $DLYAPRODAJ,
		'UF_CRM_ORGANIZATION'=>$ORGANIZATION,
		'UF_CRM_KOMMENTARII' => $KOMMENTARII,
		'UF_CRM_SELECTBOX' => $SELECTBOX,
		'UF_CRM_TYPEOFMEDIA' => $TYPEOFMEDIA,
		'UF_CRM_PRODUCT' => $PRODUCT,
		'UF_CRM_INPUT' => $INPUT,
		'UF_CRM_REGIONCITY' => $REGIONCITY,
		'UF_CRM_COMMENTS' => $COMMENTS,
		'UF_CRM_STATUSDESCRIP' => $STATUSDESCRIP,
		'UF_CRM_UFCRMDETAIL2' => $UFCRMDETAIL2,
		'UF_CRM_POST' => $POST,
		'UF_CRM_KAKIERESHENIY' => $KAKIERESHENIY,
		'UF_CRM_GDEVIUZNALION' => $GDEVIUZNALION,
		'UF_CRM_NASKOLKOMATER' => $NASKOLKOMATER,
		'UF_CRM_NASKOLKOVAMIN' => $NASKOLKOVAMIN,
		'UF_CRM_GOTOVILIVIUCH' => $GOTOVILIVIUCH,
		'UF_CRM_NAZVANIEORGAN' => $NAZVANIEORGAN,
		'UF_CRM_OSTROVNAVIBOR' => $OSTROVNAVIBOR,
		'UF_CRM_RASSKAZHITEOT' => $RASSKAZHITEOT,
		'UF_CRM_BYUDZHETVKOTO' => $BYUDZHETVKOTO,
		'UF_CRM_COMMENTS2' => $COMMENTS2,
		'UF_CRM_FORMNAME' => $FORMNAME,
      ]
   ]);




if(!empty($result['result'])){
        fwrite($handler,"Успешно".PHP_EOL);
    }elseif(!empty($result['error_description'])){
		fwrite($handler,"Ошибка:".$result['error_description'].PHP_EOL);
    }else{
        fwrite($handler,"Неизвестная ошибка".PHP_EOL);
    }
fclose($handler);
?>

