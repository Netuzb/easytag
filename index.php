<?php 

ob_start();

$API_KEY = '973959034:AAEpovRb1Or7h5vqAtr0Uny3CUgxQ6WdChs';
##------------------------------##
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model){
 bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>$text,
 'parse_mode'=>$mode
 ]);
 }
 function sendaudio($chat_id, $audio, $caption){
 bot('sendaudio',[
 'chat_id'=>$chat_id,
 'audio'=>$audio,
 'caption'=>$caption,
 ]);
 }
 function sendvoice($chat_id, $voice, $caption){
 bot('sendvoice',[
 'chat_id'=>$chat_id,
 'voice'=>$voice,
 'caption'=>$caption,
 ]);
 }
 function sendaction($chat_id, $action){
 bot('sendchataction',[
 'chat_id'=>$admin,
 'action'=>$action
 ]);
 }
 //====================ᵗᶦᵏᵃᵖᵖ======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$text = $message->text;
//====================ᵗᶦᵏᵃᵖᵖ======================//
if(preg_match('/^\/([Ss]tart)/',$text)){
sendaction($chat_id, typing);
        bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' =>"Бот MP3 форматини OGG форматига утказиб беради", 
                'reply_markup'=>json_encode([
  'inline_keyboard'=>[
    [['text'=>"Administration",'url'=>"t.me/netuzb"]],
      ]
      ]),
      ]);
        }
elseif(isset($message->audio)){
$audio = $message->audio;
$file = $audio->file_id;
      $get = bot('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents('tikapp.ogg',file_get_contents('https://api.telegram.org/file/bot'.$API_KEY.'/'.$patch));
    sendvoice($chat_id, new CURLFile('tikapp.ogg'), "Тайёр ✅");
    }
elseif(isset($message->voice)){
$voice = $message->voice;
$file = $voice->file_id;
      $get = bot('getfile',['file_id'=>$file]);
      $patch = $get->result->file_path;
      file_put_contents('tikapp.mp3',file_get_contents('https://api.telegram.org/file/bot'.$API_KEY.'/'.$patch));
    sendaudio($chat_id , new CURLFile('tikapp.mp3'), "Тайёр ✅ ");
    }
    ?>