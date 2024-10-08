<?php
class Database {
    private static $hostname = "localhost";
    private static $username = "root";
    private static $password = "";
    private static $database ="quanly_diem";
    protected static $conn = NULL;

    public static function Connect() {
        self::$conn = new mysqli(self::$hostname, self::$username, self::$password, self::$database);
        if (self::$conn->connect_error) {
            die("Kết nối tới cơ sở dữ liệu thất bại: " . self::$conn->connect_error);
        } else {
            mysqli_set_charset(self::$conn, 'utf8');
        }
    }

    public function Execute($sql) {
        $return = self::$conn->query($sql);
        return $return;
    }

    public function GetData($sql) {
        $return = self::Execute($sql);
        $arr = array();
        if ($return && $return->num_rows > 0) {
            while ($arrs = $return->fetch_assoc()) {
                $arr[] = $arrs;
            }
        } else {
            $arr = false;
        }
        return $arr;
    }
}
Database::Connect();
?>