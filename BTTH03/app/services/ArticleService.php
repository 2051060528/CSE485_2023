<?php
require_once('../app/libs/DBConnection.php');
require_once('../app/models/Article.php');
class ArticleService{
    // Cac phuong thuc thao tac voi DB Server
    public static function getAllArticles(){
        // Buoc 1: Ket noi DB Server
        $dbConnection = new DBConnection();
        $conn = $dbConnection->getConnection();
        // $conn = DBConnection::getConnection();
        // Buoc 2: Thuc hien truy van
        $sql = "SELECT * FROM article ORDER BY id DESC";
        $stmt = $conn->query($sql);

        // Buoc 3: Xu ly ket qua
        $articles = [];
        //Chuyen doi moi Ban ghi lay ra > Doi tuong: Article
        while($row=$stmt->fetch()){
            $article = new Article($row['id'],$row['title'],$row['summary'],$row['content']);
            $articles[] = $article;
        }
        return $articles;
    }
}