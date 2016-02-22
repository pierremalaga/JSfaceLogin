
<? session_start();
include 'Instagram.class.php';
$key='API_Key';
$secret='secret';
$callback='http://www.elclubdelprogramador.com/wp-content/resources/live_examples/instagram/indexInstagram.php';
$codeType='code';

$instagramObj = new Instagram($key,$secret,$callback,$codeType);
$checker = $_GET[$codeType];
if($checker == '')
{
// Solicitamos autorizacion
$url=$instagramObj->getLoginURL();

echo "<a class="button blue" href="$url">Inicia sesion en Instagram</a>";
}else {
//solicitamos access_token
$info=$instagramObj->getAccess_Token($checker);
echo "
<div style="float: left; margin-right: 10px;"><img src="\"{$info-" alt="" />user->profile_picture}\" ></div>
<div style="float: left;">";
echo '<b>Name:</b> '.$info->user->full_name.'';
echo '<b>Username:</b> '.$info->user->username.'';
echo '<b>User ID:</b> '.$info->user->id.'';
echo '<b>Bio:</b> '.$info->user->bio.'';
echo '<b>Website:</b> '.$info->user->website.'';</div>
// utilizamos un servicio
$media = $instagramObj->getUserMedia($info->user->id);

foreach ($media->data as $data) {
echo "<img src="\"{$data-" alt="" />";
}

}

?>