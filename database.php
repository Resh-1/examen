<?php

// DATABASE CONNECTION
class database{
    private $host;
    private $username;
    private $password; 
    private $database;
    private $dbh;

    public function __construct(){
        $this->host = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->database = '';

        try {
            $dsn = "mysql:host=$this->host;dbname=$this->database";
            $this->dbh = new PDO($dsn, $this->username, $this->password);

        } catch (PDOException $exception) {
            die("Connection failed!-> ".$exception.getMessage());
        }
    }
        
        //INSERT [SQL IN DE PHP MAKEN]
       public function insert($sql, $placeholder) {

        try {
            $this->dbh->beginTransaction();
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute($placeholder);
            $this->dbh->commit();

        } catch(Expection $e) {
            $this->pdo->rollback();
            throw $e;
        }
       }
    
        //LOGIN VOOR GEBRUIKERS/MEDEWERKERS
        function Login($username,$password){
            $sql = "SELECT * FROM medewerker WHERE username ='$username' and password ='$password'";
    
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute();
    
            if($stmt->rowCount() > 0){
                echo header('location:admin.php'); //Verander je location!    
            }
            else{
                echo "Incorrecte gegevens!";
            }
        }

    //SELECT -> DATABASE
    public function select($sql, $placeholder = []){
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($placeholder);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if(!empty($result)){
            return $result;
        }
        return;
    }

    //  UPDATE/EDIT VALUES VAN DE DATABASE
    public function edit($sql, $placeholder, $file){
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($placeholder);
        header("location: " . $file);
    }
    
    // DELETE EEN RECORD VAN DE DATABASE
    public function delete($sql, $placeholder, $file){
        $statement = $this->dbh->prepare($sql);
        $statement->execute($placeholder);
        header("location: " . $file);
        exit;
    }
}


    ?>
