<?PHP
require('../bd/conexao.php');

session_start();
if ($_SESSION['LoginUsuario']==''){
	
	// Redireciona o visitante de volta pro login
	header("Location: ../login.html"); exit;
	
};

$titulo = mysqli_real_escape_string($conexao,$_POST["tituloNotificacao"]);
$conteudo = mysqli_real_escape_string($conexao,$_POST["conteudoNotificacao"]);

$consulta = "SELECT * FROM `config_notificacoes` where id='1'";
$query = mysqli_query($conexao,$consulta) or die(mysqli_error());
$onesignal = mysqli_fetch_assoc($query);

$appID=$onesignal['APP_ID'];
$apiKey=$onesignal['API_KEY'];

$GLOBALS['appID']=$appID;
$GLOBALS['$apiKey']=$apiKey;

$GLOBALS['titulo']=$titulo;
$GLOBALS['conteudo']=$conteudo;


if ($appID==''||$apiKey==''){

	header("Location: ../configuracoes.php?result=onesignal"); exit;

	exit;

}else{

 function sendMessage(){
        $content = array(
            "en" => $GLOBALS['conteudo'], //MIOLO DA NOTIFICAÇÃO
            "pt" => $GLOBALS['conteudo']
            );
            
            $heading = array(
               "en" => $GLOBALS['titulo'],  //TITULO DA NOTIFICAÇÃO
               "pt" => $GLOBALS['titulo'],
            );
        
        $fields = array(
            'app_id' => ''.$GLOBALS['appID'].'', //IDENTIFICADOR DO APP
            //'include_player_ids' => array('PLAYER ID AQUI'), //EXEMPLO PLAYER ID
            'included_segments' => array('All'),
            'data' => array("foo" => "bar"),
            'contents' => $content,
            //'android_channel_id'=>'ID DO CANAL', //CANAL PARA SOM PERSONALIZADO
            'headings' => $heading
            //'send_after' => "2018-12-20 15:50:00 UTC-0200" //PARA PROGRAMAR UM DIA E HORA ESPECÍFICO
        );
        
        $fields = json_encode($fields);
             
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic '.$GLOBALS['$apiKey'].'')); // API KEY
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);


        $response = curl_exec($ch);
        curl_close($ch);
        
		header("Location: ../configuracoes.php?result=notok"); exit;
        return $response;
		
 }
 
 $response = sendMessage();
 $return["allresponses"] = $response;
 $return = json_encode($return); 
 
}
?>