<?php 

    $title = 'แข่งทักษะเขียนโปรแกรม 2567';

    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'mec01');
    
    class DB_con {
        public $pdo;

        function __construct() {
            try {
                $this->pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Failed Connect: " . $e->getMessage();
            }
        }

        function close() {
            $this->pdo = null;
        }
    }

    class functions extends DB_con {
        
        public function fetchdata_pdo() {
            $query = "SELECT * FROM users";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    // $function = new functions();
    // $users_pdo = $function->fetchdata_pdo();
    // foreach ($users_pdo as $row) {
    //     echo $row['username'] . "<br>";
    // }
    // $function->close(); // ปิดการเชื่อมต่อ

?>
