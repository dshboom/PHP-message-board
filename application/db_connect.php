<?php
    class datebaseConnection
    {
        private $server = "localhost";
        private $username = "username";
        private $password = 'password';
        private $database = "database";
        protected $connection;
        public $statement = "";
        public function __construct()
        {
            if(!isset($this -> connection))
            {
                $this->connection = new mysqli($this->server, $this->username, $this->password, $this->database);
                if (!$this->connection) {
                    echo '数据库连接失败，请尝试刷新或联系站长处理';
                    exit;
                }            
            }
            return $this -> connection;
        }
        public function closeConnection() {
            if (isset($this->connection)) {
                $this->connection->close();
            }
        }
        public function operateConnection($statement = "")
        {
            $result = $this -> connection -> query($statement);
            if (!$result) 
            {
                die("创建数据表错误: " . $this-> connection -> error);
            }
            if ($this->connection->affected_rows > 0) {
                return $result; 
            }
            // 对于非 SELECT 查询，返回 TRUE 或 FALSE 表示查询是否成功
            return ($result === true);
        }
    }
?>