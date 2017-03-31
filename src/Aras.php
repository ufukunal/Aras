<?php

namespace KS\Aras;
use KS\Aras\ArasException;
use SoapClient;
use SOAPHeader;

class Aras {
  private $url = 'http://customerservicestest.araskargo.com.tr/arascargoservice/arascargoservice.asmx?op=SetOrder&wsdl';
  private $client;
  private $conf;
  function __construct($conf){
    if(!isset($conf['username']) || !isset($conf['password'])) {
      throw new ArasException("Aras Kargo Ayarları Girilmedi");
    }

    $this->conf = $conf;

    $this->client = new SoapClient($this->url);

  }


  function CreateShipment($params){

    try {

      $data = array('orderInfo' => array('Order' => array_merge($params, array("pKullaniciAdi" => $this->conf['username'], "pSifre" => $this->conf['password']))));
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
