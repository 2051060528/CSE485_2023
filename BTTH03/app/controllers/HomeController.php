<?php
require_once('../app/services/ArticleService.php');
class HomeController{
    // Chua cac phuong thuc xu ly loi goi
    public function index(){
        // Lay du lieu CAN tu service tuong ung
        // $articleService = new ArticleService();
        // $data = $articleService->getAllArticles();
        $articles = ArticleService::getAllArticles();

        // Render ra view
        include("../app/views/home/index.php");
    }
}