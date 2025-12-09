<?php
// class/Database.php - PASTIkan kode ini lengkap

class Database {
    private $conn;

    public function __construct() {
        $host = DB_HOST;
        $user = DB_USER;
        $pass = DB_PASS;
        $name = DB_NAME;
        $port = DB_PORT; 

        // Koneksi
        $this->conn = new mysqli($host, $user, $pass, $name, $port);

        if ($this->conn->connect_error) {
            die("Koneksi Database Gagal: " . $this->conn->connect_error);
        }
    }

    // =========================================================
    // BARIS BARU: METHOD QUERY
    // =========================================================
    public function query($sql) {
        $result = $this->conn->query($sql);
        
        if ($result === false) {
            echo "Error SQL: " . $this->conn->error;
            return false;
        }
        return $result;
    }

    // =========================================================
    // BARIS BARU: METHOD FETCHALL
    // =========================================================
    public function fetchAll($sql) {
        $data = [];
        $result = $this->query($sql);

        // Pastikan $result adalah objek yang valid sebelum di-fetch
        if ($result instanceof mysqli_result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->free(); 
        }
        return $data;
    }
    // =========================================================


    public function getConnection() {
        return $this->conn;
    }

    public function __destruct() {
        if ($this->conn && !$this->conn->connect_error) {
            $this->conn->close();
        }
    }
}
?>