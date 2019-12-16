<?php
class DB {
    private $pdo;
    function __construct() {
        try {
            $this->pdo = new PDO('mysql:dbname=mydb;host=localhost', 'root', 'root');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo 'データベースの接続に失敗しました';
            echo $e->getMessages;
        }
    }

    public function fetchAll($sql, $params = array()) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll();
    }

    public function fetch($sql, $params = array()) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);
        return $sth->fetch();
    }
}
?>







<?php
/*
class DB{

    private $pdo;
    
    function __construct(){
try {
    $this->pdo = new PDO('mysql:dbname=mydb;host=localhost', 'root', 'root');
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo 'データベースの接続に失敗しました';
    echo $e->getMessages;
}

    }


    public function fetchAll($sql , $params = array()){

$sth = $this->pdo->prepare($sql);
$sth->execute($params);

return $sth->fetchAll();

    }
    public function fetch($sql, $params = array()){
        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);
        return $sth->fetch();
    }

}
 */
?>
