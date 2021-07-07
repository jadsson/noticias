<?php 

require_once 'Rules/Connection/Connection.php';
require_once 'CreateNews.php';

class RuleNews {

    function RegisterNews(CreateNews $p) {
        $sql = 'INSERT INTO news (title, category, content, id_adm) VALUES (?,?,?,?)';
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $p->getTitle());
        $stmt->bindValue(2, $p->getCategory());
        $stmt->bindValue(3, $p->getText());
        $stmt->bindValue(4, $p->getIdUser());
        if($stmt->execute()) {
            return true;
        }
        return false;

    }

    function ReadAllNews() {
        $sql = "SELECT * FROM news ORDER BY dia DESC";
        $stmt = Connection::Con()->query($sql);

        if($stmt) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    function ReadOneNews($id) {
        $sql = "SELECT * FROM news WHERE id = ?";
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if($stmt) {
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    function ReadFourNews() {
        $sql = "SELECT * FROM news ORDER BY id DESC LIMIT 4";
        $stmt = Connection::Con()->query($sql);

        if($stmt) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    function ReadNews($p) {
        $sql = "SELECT * FROM news WHERE content like '%$p%' ORDER BY id DESC";
        $stmt = Connection::Con()->query($sql);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($res) {
            return $res;
        }
        
        return [];
        
    }

    function ReadNewsForCategory($c,$p) {
        $sql = "SELECT * FROM news WHERE category = ? AND content like '%$p%' ORDER BY id DESC";
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $c);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($res) {
            return $res;
        }

        return false;
        
    }

    function ReadLastNews() {
        $sql = "SELECT MAX(id) FROM news";
        $stmt = Connection::Con()->query($sql);
        
        if($stmt) {
            $res = $stmt->fetch();
            return $res;
        }
        return [];
    }

    function ReadLastNewsFromCategory($c) {
        $sql = "SELECT MAX(id) FROM news WHERE category = ?";
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $c);
        $stmt->execute();
        if($stmt) {
            $res = $stmt->fetch();
            return $res;
        }
        return [];
    }

    function UpdateNews(CreateNews $p) {
        $sql = 'UPDATE news SET title = ?, category = ?, content = ?, id_adm_upd = ? WHERE id = ?';
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $p->getTitle());
        $stmt->bindValue(2, $p->getCategory());
        $stmt->bindValue(3, $p->getText());
        $stmt->bindValue(4, $p->getIdUpd());
        $stmt->bindValue(5, $p->getId());
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            echo '<script>alert("NOTÍCIA ATUALIZADA COM SUCESSO!");</script>';
            echo '<script>location.href="http://localhost/artigos/newsOpen.php?id='.$p->getId().'"</script>';
            return true;
        }else{
            echo '<script>alert("FALHA AO ATUALIZAR NOTÍCIA!");</script>';
            echo '<script>location.href="http://localhost/artigos/newsOpen.php?id='.$p->getId().'"</script>';
            return false;
        }
    }

    function DeleteNews($id) {
        $category = "SELECT category FROM news WHERE id = ?";
        $x = Connection::Con()->prepare($category);
        $x->bindValue(1, $id);
        $x->execute();
        $category = $x->fetch(PDO::FETCH_ASSOC);

        $sql = 'DELETE FROM news WHERE id = ?';
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            echo '<script>alert("NOTÍCIA EXCLUÍDA COM SUCESSO!");</script>';
            echo '<script>location.href="http://localhost/artigos/news.php?id='.$category['category'].'"</script>';
            return true;
        }else{
            echo '<script>alert("FALHA AO EXCLUIR NOTÍCIA!");</script>';
            return false;
        }
    }
}