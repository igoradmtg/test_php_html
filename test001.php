<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>1. Строка</title>

    </head>
<body>
<?php
// В переменной $a лежит текст новости. В переменной $link лежит ссылка на страницу с полным текстом этой новости.
// Нужно в переменную $b записать сокращенный текст новости по правилам:
// - обрезать до 180 символов
// - приписать многоточие
// - последние 2 слова и многоточие сделать ссылкой на полный текст новости.
// Какие проблемы вы видите в решении этой задачи? 
// Ответ: проблем нет, код проверил 
// Что может пойти не так?
// Ответ: если не будет хватать символов для разделения строки на более мелкие, например если строка без пробелов более 180 символов

function cut_str($str,$link,$max_size=180,$encode='UTF-8',$str_dots=' ...') {
    $str = trim($str);
    $ar_str = explode(' ',$str);// Делим строку по разделителю пробел
    $res_str = '';  // Результат функции
    $str_tag_open = '<a href="'.$link.'">'; // Строка с тегом открытия
    $str_tag_close = '</a>'; // Строка с тегом закрытия
    $max_size_real = $max_size - mb_strlen($str_tag_open . $str_tag_close . $str_dots ,$encode); // Вычисляем длину строки с учетом тегов и ссылки
    $last_key = 0;
    //echo $max_size_real . PHP_EOL;
    foreach($ar_str as $key => $str_elem) {
        if (!empty($res_str)) {
            $res_str .= ' '; // Добавляем пробел в конец строки
        }
        $len_str = mb_strlen($res_str . $str_elem,$encode); // Вычисляем длину строки
        //echo "$res_str + $str_elem $len_str " . PHP_EOL;
        if ($len_str>$max_size_real) {
            break;
        }
        $last_key = $key;
        $res_str .= $str_elem;
    }
    $res_str = '';  // Результат функции
    if ($last_key<0) {
        $res_str .= $str_tag_open;
    }
    foreach($ar_str as $key => $str_elem) {
        if (!empty($res_str)) {
            $res_str .= ' '; // Добавляем пробел в конец строки
        }
        if ($last_key == $key) {
            break;
        }
        if ($last_key-2 == $key) {
            $res_str .= $str_tag_open;
        }
        $res_str .= $str_elem;
    }
    $res_str .= $str_dots . $str_tag_close;
    return $res_str;
}

$link = 'https://yandex.ru';
$str = 'fsdfwfwefwefwefwefwegwrgwefwefwef543345yetyewrtyerty45y ertyh rety rety45 ter wert ewrt ewr ter wefwge wer fgwe fwe fwe fw efger jglewk jrw rwer gwee ler ete wer krjglke wjrglk jewrlkgj ger egrerh rthre herty';
$res = cut_str($str,$link);
echo $str . '<hr>' . PHP_EOL . 'String length:' . mb_strlen($str,'UTF-8') . '<hr>' . PHP_EOL ;
echo $link . '<hr>' . PHP_EOL;
echo $res . '<hr>' . PHP_EOL . 'String length:' . mb_strlen($res,'UTF-8');
 
?>
</body>
</html>