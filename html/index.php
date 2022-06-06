<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Google Spread Sheet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php 

require __DIR__ . '/my-sample-project/vendor/autoload.php';

$key = __DIR__ . '/my-sample-project/river-psyche-352208-8071edae4752.json';
$sheet_id = "1uSpjaEiVI6dlb7Mqozz2U17iXlXP8UDzKM2U6cMQjiw";

$client = new \Google_Client();
$client->setAuthConfig($key);
$client->addScope(\Google_Service_Sheets::SPREADSHEETS);
$client->setApplicationName("Test"); // 適当な名前でOK
$sheet = new \Google_Service_Sheets($client);

/*
 * シートデータの取得
 */
$sheet_name = "シート1"; // シートを指定
$sheet_range = "A2:B8"; // 範囲を指定。開始から終了まで斜めで囲む感じです。
$response = $sheet->spreadsheets_values->get($sheet_id, $sheet_name.'!'.$sheet_range);
foreach ($response->getValues() as $index => $cols) {
    var_dump($cols);
}

?>

</body>
</html>