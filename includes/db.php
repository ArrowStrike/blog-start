<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 06-Mar-17
 * Time: 17:44
 */
/*
 * include - просто подключает файл, если файл не был найден, он выведет сообщение с ошибкой, о том, что этот файл не был найден и продолжит дальше исполнение скрипта
 * include_once - если файл уже был подключен, то больше он его не подключит
 * require - если файл не был найден, выдаст фатальную ошибку и закончит исполнение скрипта
 * require_once - если файл уже был подключен, то больше он его не подключит
 * */
$connection = mysqli_connect(
    $config['db']['server'],
    $config['db']['username'],
    $config['db']['password'],
    $config['db']['name']
);

if ($connection == false) {
    echo 'Не удалось подключиться к базе данных!<br>';
    echo mysqli_connect_error();
    exit();
}
function introArticle($text, $word_limit, $size)
{
    $textSize=mb_strlen($text);
    if ($textSize>$size){
        $text = mb_substr($text, 0, $size);
        $words = explode(' ', $text, ($word_limit + 1));
        array_pop($words);
        echo implode(' ', $words) . '...';
    }
    else {
        $words = explode(' ', $text, ($word_limit + 1));
        $words_in_text = count(explode(' ', $text));
        if (count($words) > $word_limit)
            array_pop($words);
        if ($words_in_text > $word_limit) {
            echo implode(' ', $words) . '...';
        } else echo implode(' ', $words);
    }
}
/*
{
    $textSize=strlen($text);
    if ($textSize>50){
        $text = mb_substr($text, 0, 50);
        $words = explode(' ', $text, ($word_limit + 1));
        array_pop($words);
        echo implode(' ', $words) . '...';
    }
    else {
        $words = explode(' ', $text, ($word_limit + 1));
        $words_in_text = count(explode(' ', $text));
        if (count($words) > $word_limit)
            array_pop($words);
        if ($words_in_text > $word_limit) {
            echo implode(' ', $words) . '...';
        } else echo implode(' ', $words);
    }
}*/
function translit($title)
{

    //  $title = preg_replace('~[^-a-z0-9_]+~u', '-', $title);
    static $converter = array(
        'а' => 'a', 'б' => 'b', 'в' => 'v',
        'г' => 'g', 'д' => 'd', 'е' => 'e',
        'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
        'и' => 'i', 'й' => 'y', 'к' => 'k',
        'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u',
        'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
        'ы' => 'y',
        'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

        'А' => 'A', 'Б' => 'B', 'В' => 'V',
        'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
        'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
        'И' => 'I', 'Й' => 'Y', 'К' => 'K',
        'Л' => 'L', 'М' => 'M', 'Н' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R',
        'С' => 'S', 'Т' => 'T', 'У' => 'U',
        'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
        'Ы' => 'Y',
        'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
    );

    $converted = strtr($title, $converter);
    $converted = strtolower($converted);
    $converted = preg_replace("/[\s]/", "-", $converted);
    $converted = preg_replace("/[^a-z0-9-]/", "", $converted);
    return $converted;
}



