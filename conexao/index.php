<?php

class RemoteDatabaseConnectionTest {
    private $host;
    private $username;
    private $password;
    private $database;

    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function testConnection() {
        $connection = @mysqli_connect($this->host, $this->username, $this->password, $this->database);

        if ($connection) {
            mysqli_close($connection);
            return "Conexão com a base de dados remota bem-sucedida!";
        } else {
            return "Falha na conexão com a base de dados remota: " . mysqli_connect_error();
        }
    }
}

// Exemplo de uso
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'kor_ndev_kaos_data';
$connectionTest = new RemoteDatabaseConnectionTest($host, $username, $password, $database);
echo $connectionTest->testConnection();

?>
