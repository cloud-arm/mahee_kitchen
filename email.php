<?php
$from="00947792525940@vtext.com";
$to="0094779252594@vtext.com";
$sub="Test";
$masseg="Hello Eranda Palliyaguru";

mail($to, $sub, $masseg, "From:".$from);

print 'Email send sucsses';



$user = "94779252594";
$password = "7432";
$text = urlencode("සිංහල යුනිකෝඩ්");
$to = "0772955659";

$baseurl ="http://www.textit.biz/sendmsg";
$url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text";
$ret = file($url);

$res= explode(":",$ret[0]);

if (trim($res[0])=="OK")
{
echo "Message Sent – ID : ".$res[1];
}
else
{
echo "Sent Failed – Error : ".$res[1];
}




?>