<?php

require_once 'Rules/Connection/Connection.php';
require_once 'CreateComment.php';

class RuleComment {

    function RegisterComment(CreateComment $p) {
        $sql = 'INSERT INTO comments (id_img, id_news, id_user, content) VALUES (?,?,?,?)';
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $p->getIdImg());
        $stmt->bindValue(2, $p->getIdNews());
        $stmt->bindValue(3, $p->getIdUser());
        $stmt->bindValue(4, $p->getText());
        $stmt->execute();

    }

    function ReadOneComment($id) {
        $sql = "SELECT * FROM comments WHERE id = ?";
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if($stmt) {
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        return false;
    }

    function ReadComments() {
        $sql = 'SELECT * FROM comments';
        $stmt = Connection::Con()->query($sql);
        if($stmt->rowCount() > 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    function ReadAllCommentFromOneNews($id_news) {
        $sql = "SELECT tu.user_name, tu.type_user, tc.id, tc.content, tc.id_user, tc.dia FROM users as tu 
                INNER JOIN comments as tc ON tu.id = tc.id_user 
                INNER JOIN news as n ON tc.id_news = '$id_news' AND tc.id_news = n.id
                ORDER BY tc.dia";
        $stmt = Connection::Con()->query($sql);
        if($stmt) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    function ReadAllCommentFromOneImg($id_img) {
        $sql = "SELECT * FROM comments WHERE id_img = ?";
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $id_img);
        $stmt->execute();
        if($stmt) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    function ReadAllCommentFromOneUser($id_user, $search) {
        $sql = "SELECT tu.user_name, n.title, tc.content, tc.dia, tc.id_news  FROM users as tu
                INNER JOIN comments as tc ON tu.id = tc.id_user AND tc.id_user = '$id_user' AND tc.content LIKE '%$search%'
                INNER JOIN news as n ON tc.id_news = n.id
                ORDER BY tc.dia DESC";
        $stmt = Connection::Con()->query($sql);
        if($stmt) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    function UpdateComment(){}

    function DeleteComment($id) {
        $sql = 'DELETE FROM comments WHERE id = ?';
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        if($stmt) {
            return true;
        }
        return false;
    }
}