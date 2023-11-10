<?php
namespace ZF\App;

class Database
{
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $pdo;

    public function __construct()
    {
        $this->host = getenv('DB_HOST');
        $this->dbname = getenv('DB_DATABASE');
        $this->username = getenv('DB_USERNAME');
        $this->password = getenv('DB_PASSWORD');
        
        // Membuat koneksi \PDO
        try {
            $this->pdo = new \PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function query($sql, $params = [])
    {
        // Contoh query INSERT
        // $db->query('INSERT INTO users (username, email) VALUES (:username, :email)', [
        //     'username' => 'john_doe',
        //     'email' => 'john.doe@example.com'
        // ]);

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            return $statement;
        } catch (\PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    public function fetchAll($sql, $params = [])
    {
        // Contoh query SELECT
        // $result = $db->fetchAll('SELECT * FROM users WHERE id = :id', ['id' => 1]);
        $statement = $this->query($sql, $params);
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetch($sql, $params = [])
    {
        $statement = $this->query($sql, $params);
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    // Tambahkan metode lain sesuai kebutuhan
}