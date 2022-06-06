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

ini_set('display_errors', 1);
error_reporting(E_ALL);

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

try {
    //データベース名、ユーザー名、パスワード
    $dsn = 'mysql:dbname=test;host=c568cfe25d54;charset=utf8';
    $user = 'test';
    $password = 'test';
    //MySQLのデータベースに接続
    $pdo = new PDO($dsn, $user, $password);
    //PDOのエラーレポートを表示
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach ($response->getValues() as $index => $cols) {
        // INSERT文を変数に格納
        // あらかじめMySQL内にテーブルとカラムを作成しておく必要がある
        $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
        //挿入する値は空のまま、SQL実行の準備をする
        $stmt = $pdo->prepare($sql);
        // 挿入する値を配列に格納する
        $params = array(':name' => $cols[0], ':email' => $cols[1]);
        //挿入する値が入った変数をexecuteにセットしてSQLを実行
        $stmt->execute($params);
    }

    echo '登録しました！';

} catch (PDOException $e) {
    exit('データベースに接続できませんでした。' . $e->getMessage());
}

?>

</body>
</html>