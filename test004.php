<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>4. Массивы</title>

    </head>
<body>
<?php
// 4. Массивы
// Дан массив из 100 элементов. Требуется вывести количество последовательных пар одинаковых элементов
// Например: 1, 1, 2, 3, 4 -51, 12, 12, 12, -51

$max = 100;
for ($count=0;$count<=$max;$count++) {
    print_r($arr[$count] = rand(-10,+10) . ', ');
}
$count=0; // Счетчик
$arr_doubel_info=[]; // Массив для сохранения пар
for($i=0;$i<$max;$i++) {
    $i_next = $i+1;    
	if ($arr[$i] == $arr[$i_next]){
        $count++;
        $arr_doubel_info[] = "Key:$i Val:{$arr[$i]} = Key:{$i_next} Val:{$arr[$i_next]}";
	}
}
echo '<br>' . PHP_EOL;
echo " Количество последовательных пар одинаковых элементов - " . $count . PHP_EOL;
echo '<pre>';
print_r($arr_doubel_info);
echo '</pre>';
?>
</body>
</html>
