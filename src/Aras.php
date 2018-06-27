<?php

namespace KS\Aras;
use KS\Aras\ArasException;
use SoapClient;
use SOAPHeader;

class Aras {
  private $sandbox_url = 'http://customerservicestest.araskargo.com.tr/arascargoservice/arascargoservice.asmx?op=SetOrder&wsdl';
  private $url = 'http://customerws.araskargo.com.tr/arascargoservice.asmx?op=SetOrder&wsdl';
  private $client;
  private $conf;
  function __construct($conf){
    if(!isset($conf['username']) || !isset($conf['password'])) {
      throw new ArasException("Aras Kargo Ayarları Girilmedi");
    }

    $this->conf = $conf;

    if(isset($this->conf['sandbox'])){
      $this->client = new SoapClient($this->sandbox_url);
    } else {
      $this->client = new SoapClient($this->url);
    }
    

  }


  function CreateShipment($params){

    try {
      
      $data = [
        'orderInfo' => [
          'Order' => array_merge(
            $params,
            [
              'UserName' => $this->conf['username'],
              'Password' => $this->conf['password']
            ]
          ),
          'userName' => $this->conf['username'],
          'password' => $this->conf['password']
        ]
      ];

      $CreateShipmentData = $this->client->SetOrder ($data);
      
      if(isset($CreateShipmentData->SetOrderResult)){
        return $CreateShipmentData->SetOrderResult->OrderResultInfo;
      } else {
        throw new ArasException("Gönderdiğiniz parametreleri kontrol ediniz!");
      }

    } catch (SoapFault $sf) {
      throw new ArasException($sf);
    }
  }
}
