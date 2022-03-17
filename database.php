<?php 
    class database{

        private $host;
        private $dbh;
        private $user;
        private $pass;
        private $db;
        private $charset;


        function __construct(){
            $this->host = "localhost";
            $this->user = "root";
            $this->pass = "";
            $this->db = "EXAMPLE";
            $this->charset = "utf8mb4";

            try{
                $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
                $options = [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES   => false,
                ];
                $this->dbh = new PDO($dsn,$this->user,$this->pass,$options);
            }catch(PDOException $e){
                die("Unable to connect". $e->GetMessage());
            }
        }
        //Login voor klanten
        function klantLogin($username,$password){
            $sql = "SELECT * FROM EXAMPLE WHERE username ='$username' and password ='$password'";

            $stmt = $this->dbh->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                echo header('location:example.php'); //Verander je location!    
            }
        }
        //Account aanmaken voor klanten
        function klantCreate($example){
            //Statement om te checken of er al een user met de zelfde username bestaat
            $sql = "SELECT EXAMPLE from EXAMPLE WHERE EXAMPLE = '$EXAMPLE'";

            $stmt = $this->dbh->prepare($sql);
            $stmt->execute();
            //Als er al een account met dezelfde naam is is de statement TRUE
                if($stmt->rowCount() >0){
                    echo "This phonenumber has already been used";
            //Account wordt aangemaakt
                } else{
                    $sql2 = "INSERT INTO user(example,example) 
                        VALUES (:example,:example)";    
                    $stmt = $this->dbh->prepare($sql2);
                    $stmt->execute([
                        'example' => null, 
                        'example' => $firstname, 
                    ]);
                    echo header('location:get-order.php');   
                }
        }
        //Alle data krijgt de mogelijkheid om opgeroepen te worden in de INDEX
        function lijstExample(){
            //Statement om alle data te selecteren
            $sql = "SELECT * FROM example";
            //Data wordt geprepared en execute
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>