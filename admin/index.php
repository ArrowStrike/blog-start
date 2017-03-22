<?php
require_once("database.php");
require_once("articles.php");

$link = db_connect();
$version = 1;
//$article['title'] = '';
//$article['text'] = '';


if ($_POST['searchArticle']&&!empty($_POST)) {
        $matchFound = searchArticles($link, $_POST['searchArticle']);
}

$action = "";
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
if ($action != null) {
    if ($action == 'add') {
        if ($_FILES['image']['name'] != null) {
            uploadImage();
        } else {
            $_FILES['image']['name'] = 'default.jpg';
        }

        if (!empty($_POST)) {
            articlesNew($link, (int)$_POST['category_id'], $_POST['title'], $_FILES['image']['name'], $_POST['text']);
            redirect("index.php");
        }
        $categories = categoriesGet($link);
        include("addEditPage.php");
    }
    if ($action == 'edit') {//входящий параметр action = edit

        if (!isset($_GET['id'])) {//если не установлен параметр id, не знаем, какую открывать статью для редактирования
            redirect("index.php");
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
            redirect("index.php");//переадрессация на главную страницу
        }
        $article = articleGet($link, $articleID);
        include("addEditPage.php");  //отображаем данные для редактирования
    }
    if ($action == 'delete') {
        $articleID = (int)$_GET['id'];
        $isImage = articleGet($link, $articleID);
        if ($isImage['image'] != null) {
            deleteImage($link, $articleID);
        }
        $article = articlesDelete($link, $articleID);
        if (isset($_GET['page'])) {
            redirect('index.php?page=' . $_GET['page']);
        } else {
            redirect("index.php");//переадресация на главную страницу
        }
    }
    if ($action == 'deleteImage') {
        $articleID = (int)$_GET['id'];
        $isImage = articleGet($link, $articleID);
        if ($isImage['image'] != null) {
            deleteImage($link, $articleID);
        }
        redirect('index.php?action=edit&id=' . $articleID);
    }
    if ($action == 'changeImage') {
        $articleID = (int)$_GET['id'];
        $isImage = articleGet($link, $articleID);
        if ($_FILES['image']['name'] != null) {
            deleteImage($link, $articleID);
            uploadImage();
            changeImageName($link, $articleID, $_FILES['image']['name']);
        }
        redirect('index.php?action=edit&id=' . $articleID);
    }
    if ($action == 'deleteCategory') {
        $categories = categoryDelete($link, (int)$_POST['category_id']);
        redirect("index.php");
    }
    if ($action == 'addCategory') {
        if (!empty($_POST)) {
            categoryNew($link, $_POST['newNameOfCategory']);
            redirect("index.php");
        }
        redirect("index.php");//переадресация на главную страницу
    }
    if ($action == 'deleteComment') {
        $id = (int)$_GET['id'];
        $articleID = (int)$_GET['articleID'];
        $comments = deleteComment($link, $id, $articleID);
        redirect("index.php?action=edit&id=" . $articleID);
    }
} else {
    $categories = categoriesGet($link);
    $articles = articlesAll($link);
    include("adminPage.php");
}
