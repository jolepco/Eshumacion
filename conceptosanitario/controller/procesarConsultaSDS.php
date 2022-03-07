<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://appb.saludcapital.gov.co/SivigilaDC/WebServiceIVCSCS.asmx?wsdl",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:tem=\"http://tempuri.org/\">\r\n   <soapenv:Header/>\r\n   <soapenv:Body>\r\n      <tem:ConsultarSolicitud>\r\n         <!--Optional:-->\r\n         <tem:pLogin>UsuarioIVCSDS</tem:pLogin>\r\n         <!--Optional:-->\r\n         <tem:pContrasena>Brsageco2019</tem:pContrasena>\r\n         <!--Optional:-->\r\n         <tem:NroSoicitud>1</tem:NroSoicitud>\r\n      </tem:ConsultarSolicitud>\r\n   </soapenv:Body>\r\n</soapenv:Envelope>",
  CURLOPT_HTTPHEADER => array(
    "SOAPAction: http://tempuri.org/ConsultarSolicitud",
    "Content-Type: text/xml",
    "Cookie: ASP.NET_SessionId=smccmt55252yey45wsuasc45"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

var_dump($response);