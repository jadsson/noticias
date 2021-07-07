<?php 

require_once 'Rules/Connection/Connection.php';
require_once 'CreateImage.php';

class RuleImg {

    function RegistImg(CreateImage $p) {
        $sql = 'INSERT INTO img (id_user, id_news, title, category, nome) VALUES (?,?,?,?,?)';
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $p->getIdUser());
        $stmt->bindValue(2, $p->getIdNews());
        $stmt->bindValue(3, $p->getTitle());
        $stmt->bindValue(4, $p->getCategory());
        $stmt->bindValue(5, $p->getNome());
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Seleciona todas as imagens
     */
    function ReadImgs() {
        $sql = "SELECT * FROM img ORDER BY id DESC";
        $stmt = Connection::Con()->query($sql);
        if($stmt) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    /**
     * Seleciona 5 imagens para a tela inicial
     */
    function ReadFiveImgs() {
        $sql = "SELECT * FROM img WHERE category != 'news' ORDER BY id DESC LIMIT 5";
        $stmt = Connection::Con()->query($sql);

        if($stmt) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    /**
     * Mostrar as imagens que um usuário enviou
     */
    function ReadImgFromUser($id) {
        $sql = "SELECT * FROM img WHERE id_user = ? AND category != 'news' ORDER BY id DESC";
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if($stmt) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    /**
     * Seleciona a imagem com o id
     */
    function ReadOneImg($id) {
        $sql = "SELECT * FROM img WHERE id = ?";
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        if($res) {
            return $res;
        }
        return [];
    }

    /**
     * Seleciona as imagens relacionadas com a notícia 
     */
    function ReadAllImgOfOneNews($id) {
        $sql = "SELECT * FROM img WHERE id_news = ?";
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        if($stmt) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    /**
     * Seleciona as imagens pela categoria
     */
    function ReadImgForCategory($p) {
        $sql = "SELECT * FROM img WHERE category = ?";
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $p);
        $stmt->execute();

        if($stmt) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        return [];
    }

    /**
     * Mostra o id da primeira imagem relacionada à notícia
     * Vai ser a capa do card da notícia
     */
    function ReadFirstImgFromOneNews($idNews) {
        $sql = "SELECT MIN(id) FROM img WHERE id_news = ?";
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $idNews);
        if($stmt->execute()) {
            $res = $stmt->fetch();
            return $res;
        }

        return [];
        
    }

    function UpdateImg(CreateImage $p) {
        $sql = 'UPDATE img SET title = ? WHERE id = ?';
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $p->getTitle());
        $stmt->bindValue(2, $p->getId());
        $stmt->execute();
    }

    function DeleteImg($name) {
        $sql = 'DELETE FROM img WHERE nome = ?';
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $name);
        $stmt->execute();
    }
}