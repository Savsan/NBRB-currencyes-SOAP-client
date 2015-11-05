<?
/*$client = new SoapClient("http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL");
//$client = new SoapClient("http://www.nbrb.by/Services/ExRates.asmx?wsdl");
/*echo '<pre>';
print_r($client->__getFunctions());*/
//try{
	// Сколько новостей всего?
	/*$dateTime = array('On_date' => date('Y-m-d'),);
	$res = $result->client->GetCursOnDateXML($dateTime);
	
	$res->GetCursOnDateXMLResult->any;
	print_r($res);
	// Сколько новостей в категории Политика?
	$result = $client->getNewsCountByCat(1);
	echo "<p>Всего новостей в категории Политика: $result</p>";
	
	// Покажем конкретную новость
	$result = $client->getNewsById(1);
	$news = unserialize(base64_decode($result));
	var_dump($news);*/
//	}catch(SoapFault $e){
//		echo 'Операция '.$e->faultcode.' вернула ошибку: '.$e->getMessage();
//	}

$wsdl = 'http://www.nbrb.by/Services/ExRates.asmx?wsdl';
 
$client = new SoapClient($wsdl);

$date = new DateTime(date("Y-m-d"));

$param = array('onDate' => $date->format('Y-m-d').'T'.$date->format('H:i:s'));
$result = $client->ExRatesDaily($param);
 
$data = new SimpleXMLElement($result->ExRatesDailyResult->any);
echo "<pre>";
print_r($data);
echo "<pre>";
foreach ($data->NewDataSet->DailyExRatesOnDate as $curs) {
    printf('%s = %s Руб', trim($curs->Cur_QuotName), floatval($curs->Cur_OfficialRate));
    echo PHP_EOL;
}