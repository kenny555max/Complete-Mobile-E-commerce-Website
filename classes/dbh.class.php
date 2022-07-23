<?php

    class DBH {
        protected $host = "localhost";
        protected $username = "root";
        protected $password = "";
        protected $dbname = "cartitem2";

        public $conn;

        public function __construct() {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

            if ($this->conn->connect_error) {
                die("Connection Failed: ".mysqli_connect_error());
            }
        }

        public function __destruct() {
            $this->destroyConnection();
        }

        public function destroyConnection() {
            if ($this->conn !== null) {
                $this->conn->close();
                $this->conn = null;
            }
        }
    }