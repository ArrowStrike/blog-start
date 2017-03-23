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
function introArticle($text, $word_limit = 15)
{
    $words = explode(' ', $text, ($word_limit + 1));
    $words_in_text = count(explode(' ', $text));
    if (count($words) > $word_limit)
        array_pop($words);
    if ($words_in_text > $word_limit)
        echo implode(' ', $words) . '...';
    else echo implode(' ', $words);
}

