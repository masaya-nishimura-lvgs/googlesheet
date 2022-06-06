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
    $result=file_get_contents('https://docs.google.com/spreadsheets/d/1uSpjaEiVI6dlb7Mqozz2U17iXlXP8UDzKM2U6cMQjiw/edit?usp=sharing');
    $arr=json_decode($result,true);
    $data=$arr['feed']['entry'];
?>
<table>
    <tr>
        <td>No.</td>
        <td>Name</td>
        <td>Email</td>
    </tr>
    <?php
    var_dump($data);
    //     $i=1; 
    //     foreach($data as $list){
    //         $str=$list['content']['$t'];
    //         $arr=explode(",",$str);
    //         $emailArr=explode(":",$arr[0]);
    //         echo "<tr>
    //             <td>$i</td>
    //             <td>".$list['title']['$t']."</td>
    //             <td>".$emailArr[1]."</td>
    //         </tr>";
    //         $i++;
    // }
    ?>
</table>
</body>
</html>