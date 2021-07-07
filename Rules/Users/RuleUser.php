<?php

require_once 'Rules/Connection/Connection.php';
require_once 'RuleUser.php';

class RuleUser {

    function RegisterUser(CreateUser $p) {
        $sql = 'SELECT * FROM users WHERE user_name = ?';
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $p->getUserName());
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            echo '<script>alert("ESTE NOME DE USUÁRIO JÁ EXISTE!");</script>';
            return false;
            exit;
        } else {
            $sql = 'SELECT * FROM users WHERE email = ?';
            $stmt = Connection::Con()->prepare($sql);
            $stmt->bindValue(1, $p->getEmail());
            $stmt->execute();

            if($stmt->rowCount() > 0) {
                echo '<script>alert("ESTE EMAIL JÁ EXISTE!");</script>';
                return false;
                exit;
            } else {
                $sql = 'INSERT INTO users (user_name, email, pwd) VALUES (?,?,?)';
                $stmt = Connection::Con()->prepare($sql);
                $stmt->bindValue(1, $p->getUserName());
                $stmt->bindValue(2, $p->getEmail());
                $stmt->bindValue(3, password_hash($p->getPassword(), PASSWORD_DEFAULT));
                $res = $stmt->execute();

                if($res) {
                    return true;
                }
                return false;
            }
        }
    }

    function ReadUser($search) {
        $sql = "SELECT * FROM `users` WHERE user_name LIKE '%$search%' OR email LIKE '%$search%' OR type_user LIKE '%$search%'";
        $stmt = Connection::Con()->query($sql);
        
        if($stmt->rowCount() > 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        return false;
    }

    function ReadAdm() {
        $sql = 'SELECT * FROM users WHERE type_user = master AND type_user = adm ORDER BY user_name';
        $stmt = Connection::Con()->query($sql);
        
        if($stmt->rowCount() > 0) {
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        return false;
    }

    /**
     * PEGAR OS DADOS DE UM USUÁRIO
     */
    function ReadOneUser($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if($stmt) {
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res;
        }
        return [];
    }

    /**
     * MOSTRAR OS DADOS DE UM USUÁRIO PASSANDO O EMAIL COMO PARÂMETRO
     */
    function ReadOneUserFromEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            $d = $stmt->fetch(PDO::FETCH_ASSOC);
            return $d;
        }
        return [];
    }

    /**
     * ATUALIZAR USERNAME E SENHA
     * 
     * VERIFICA SE NÃO EXISTE O USERNAME ANTES DE SER ATUALIZADO
     */
    function UpdateUser(CreateUser $p) {
        $sql = 'SELECT user_name FROM users WHERE user_name = ? AND id != ?';
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $p->getUserName());
        $stmt->bindValue(2, $p->getId());
        $stmt->execute();
    
        if($stmt->rowCount() > 0) {
            echo "<script>alert('ESTE NOME DE USUÁRIO JÁ EXISTE')</script>";
            return false;
        }else{
            $sql = "UPDATE users SET user_name = ?, type_user = ?, pwd = ? WHERE id = ?";
            $stmt = Connection::Con()->prepare($sql);
            $stmt->bindValue(1, $p->getUserName());
            $stmt->bindValue(2, $p->getType());
            $stmt->bindValue(3, password_hash($p->getPassword(), PASSWORD_DEFAULT));
            $stmt->bindValue(4, $p->getId());
            $stmt->execute();
            echo "<script>alert('OS DADOS DESTE USUÁRIO FORAM ATUALIZADOS')</script>";
            echo '<script>location.href="http://localhost/artigos/index.php"</script>';

            return true;
        }
    }

    /**
     * CONFIRMA SENHA DO ADM AO EXCLUIR NOTÍCIA
     */
    function ConfirmPass(CreateUser $p) {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $p->getEmail());
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $d = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($p->getPassword(), $d['pwd'])){
                return true;
            }else{
                echo "<script>alert('SENHA INVÁLIDA')</script>";
                return false;
            }
        }
    }

    /**
     * ADM EXCLUINDO USUÁRIOS
     */
    function DeleteUser($id) {
        $sql = 'DELETE FROM users WHERE id = ?';
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if($stmt) {
            echo "<script>alert('USUÁRIO EXCLUÍDO COM SUCESSO')</script>";
            echo '<script>location.href="http://localhost/artigos/showUsers.php"</script>';
            return true;
        }
        return false;
    }

    /**
     * USUÁRIOS EXCLUINDO SUAS CONTAS
     */
    function UserDeleteSelf($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        if($stmt) {
            echo "<script>alert('OBRIGADO PELO SEU TEMPO CONOSCO \n ESPERAMOS QUE VOLTE EM BREVE\n\n TODOS OS SEUS DADOS FORAM DELETADOS DO NOSSO BANCO ')</script>";
            echo '<script>location.href="http://localhost/artigos/Php/exit.php"</script>';
            return true;
        }
        return false;
    }

    function Login(CreateUser $p) {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $stmt = Connection::Con()->prepare($sql);
        $stmt->bindValue(1, $p->getEmail());
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $d = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($p->getPassword(), $d['pwd'])) {
                if(!isset($_SESSION))session_start();
                if($d['type_user'] == 'master') {
                    $_SESSION['id_master'] = $d['id'];

                }

                if($d['type_user'] == 'adm') {
                    $_SESSION['id_adm'] = $d['id'];

                }
                
                if($d['type_user'] == 'comum') {
                    $_SESSION['id'] = $d['id'];
                }
                $_SESSION['username'] = $d['user_name'];
                $_SESSION['type'] = $d['type_user'];
                $_SESSION['email'] = $d['email'];

                header('location: index.php');
                return true;

            } else {
                echo "<script>alert('SENHA INCORRETA')</script>";
            }

        } else {
            echo '<script>alert("ESTE EMAIL NÃO ESTÁ CADASTRADO")</script>';
        }

        return false;
    }
}