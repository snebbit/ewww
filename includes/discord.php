<?php
function discordmsg($msg, $webhook) {
  if($webhook != "") {
    $ch = curl_init($webhook);
    $msg = "payload_json=" . $msg."";
    echo $msg;
    
    if(isset($ch)) {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $msg);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bot NDMyODg3Nzc3NjgwNTU2MDMz.Daz1tA.upeUfuaMU9Xc6LAcWPRltktNuSQ'));
      $result = curl_exec($ch);
      curl_close($ch);
      return $result;
    }
  }
}


$webhook = "https://discordapp.com/api/webhooks/432883376152641537/QBL8G4SggDtU5tn4AsTVthSWiAy8CuwArMbfHAEc66Nxbd50akcA3v5Ls2fieoF6bLE2"; 
$discord_msg = '
{
    "username":"theHaus#0966",
    "content":"bh,j,vhjvygfifyifyhkj.",
    "embeds": [{
        "title":"The Link Title",
        "description":"The Link Description",
        "url":"https://www.thelinkurl.com/",
        "color":DECIMALCOLORCODE,
        "author":{
            "name":"Site Name",
            "url":"https://www.sitelink.com/",
            "icon_url":"URLTOIMG"
        },
    }]
}
';
global $webhook;
global $discord_msg;