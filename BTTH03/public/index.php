<?php
// Routing: dieu huong
// Kiem tra URL cua nguoi dung > Tim ra Controller
// URL: tlu.edu.vn/ = tlu.edu.vn/index.php?route=home > HomeController
// URL: tlu.edu.vn/index.php?route=articles > ArticleController
// URL: tlu.edu.vn/article/1/edit

$route = isset($_GET['route'])?$_GET['route']:'home';

if($route == 'home'){
    require_once('../app/controllers/HomeController.php');
    $homeController = new HomeController();
    $homeController->index();
}else if($route=='articles'){
    require_once('../app/controllers/ArticleController.php');
    $articleController = new ArticleController();
    $articleController->index();
}else{
    echo "Other";
}
?>