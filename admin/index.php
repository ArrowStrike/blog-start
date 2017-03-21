<?php
require_once("database.php");
require_once("articles.php");

$link = db_connect();
$version = 1;
$article['title'] = '';
$article['text'] = '';


if ($_POST['searchArticle']) {
    if (!empty($_POST)) {
        $matchFound = searchArticles($link, $_POST['searchArticle']);
        //  header("Location: index.php");
    }
    //  header('Location: index.php');//переадресация на главную страницу
}


if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = "";
}

if ($action == 'add') {
    if ($_FILES['image']['name'] != null) {
        uploadImage();
    } else {
        $_FILES['image']['name'] = 'default.jpg';
    }

    if (!empty($_POST)) {
        articlesNew($link, (int)$_POST['category_id'], $_POST['title'], $_FILES['image']['name'], $_POST['text']);
        header("Location: index.php");
    }
    $categories = categoriesGet($link);
    include("addEditPage.php");
} else if ($action == 'edit') {//входящий параметр action = edit

    if (!isset($_GET['id'])) {//если не установлен параметр id, не знаем, какую открывать статью для редактирования
        header('Location: index.php');
    }//переправляем на клавную страницу администратора
    $articleID = (int)$_GET['id'];//если параметр задан, то конвертируем его в тип int
    $categories = categoriesGet($link);
    $category = categoryGet($link, $articleID);
    $comments = getComments($link, $articleID);
    //если постданные пустые
    if (!empty($_POST) && $articleID > 0) {//введенные параметры не должны быть пустыми//$_POST введенные данные
        if ($_FILES['image']['name'] != null) {
            deleteImage($link, $articleID);
            uploadImage();
        }
        articlesEdit($link, $articleID, (int)$_POST['category_id'], $_POST['title'], $_FILES['image']['name'], $_POST['text']);
        header("Location: index.php");//переадрессация на главную страницу
    }
    $article = articleGet($link, $articleID);
    include("addEditPage.php");  //отображаем данные для редактирования
} else if ($action == 'delete') {
    $articleID = $_GET['id'];
    $isImage = articleGet($link, $articleID);
    if ($isImage['image'] != null) {
        deleteImage($link, $articleID);
    }
    $article = articlesDelete($link, $articleID);
    if (isset($_GET['page'])) {
        header('Location: index.php?page=' . $_GET['page']);
    } else {
        header('Location: index.php');//переадресация на главную страницу
    }
} else if ($action == 'deleteImage') {
    $articleID = $_GET['id'];
    $isImage = articleGet($link, $articleID);
    if ($isImage['image'] != null) {
        deleteImage($link, $articleID);
    }
    header('Location: index.php?action=edit&id=' . $_GET['id']);
} else if ($action == 'changeImage') {
    $articleID = $_GET['id'];
    $isImage = articleGet($link, $articleID);
    if ($_FILES['image']['name'] != null) {
        deleteImage($link, $articleID);
        uploadImage();
        changeImageName($link, $articleID,$_FILES['image']['name']);
    }
    header('Location: index.php?action=edit&id=' . $_GET['id']);
}
else if ($action == 'deleteCategory') {
    $categories = categoryDelete($link, (int)$_POST['category_id']);
    header('Location: index.php');
} else if ($action == 'addCategory') {
    if (!empty($_POST)) {
        categoryNew($link, $_POST['newNameOfCategory']);
        header("Location: index.php");
    }
    header('Location: index.php');//переадресация на главную страницу
} else if ($action == 'deleteComment') {
    $id = $_GET['id'];
    $articleID = $_GET['articleID'];
    $comments = deleteComment($link, $id, $articleID);
    $path = "Location: index.php?action=edit&id=" . $articleID;
    header($path);//переадресация на главную страницу
} else {
    $categories = categoriesGet($link);
    $articles = articlesAll($link);
    include("adminPage.php");
}
