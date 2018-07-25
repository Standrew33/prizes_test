<?php
class dbConnect {
    private $dbName = 'prize_test';
    private $dbHost = '127.0.0.1';
    private $dbUser = 'mysql';
    private $dbPassword = 'mysql';
    private $connectLink = null;

    //Чтобы нельзя было создать через клонирование
    private function __clone() { /* ... */
    }

    //Чтобы нельзя было создать через unserialize
    private function __wakeup() { /* ... */
    }

    //Соединяемся с базой
    public function openConnection() {
        if (is_null($this->connectLink)) {
            $this->connectLink = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);
            $this->connectLink->set_charset("utf8");
            if (mysqli_connect_errno()) {
                printf("Подключение невозможно: %s\n", mysqli_connect_error());
                $this->connectLink = null;
            } else {
                mysqli_report(MYSQLI_REPORT_ERROR);
            }
        }
        return $this->connectLink;
    }

    //Закрываем соединение с базой
    public function closeConnection() {
        if (!is_null($this->connectLink)) {
            $this->connectLink->close();
        }
    }
}

?>