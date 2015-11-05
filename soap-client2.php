<?
// Ссылка на wsdl документ сервиса Нацбанка Беларуси по курсам валют
$wsdl = 'http://www.nbrb.by/Services/ExRates.asmx?wsdl';
 
// Объект SOAP клиента
$client = new SoapClient($wsdl);

$date = new DateTime(date("Y-m-d"));

$param = array('onDate' => $date->format('Y-m-d').'T'.$date->format('H:i:s'));
$result = $client->ExRatesDaily($param);
 
$data = new SimpleXMLElement($result->ExRatesDailyResult->any);
echo "<pre>";
print_r($data);
echo "<pre>";
/*foreach ($data->NewDataSet->DailyExRatesOnDate as $curs) {
    printf('%s = %s Руб', trim($curs->Cur_QuotName), floatval($curs->Cur_OfficialRate));
    echo PHP_EOL;
}*/
foreach ($data->NewDataSet->DailyExRatesOnDate as $cursDollara) {
    echo $cursDollara->Cur_Abbreviation."\n";
}