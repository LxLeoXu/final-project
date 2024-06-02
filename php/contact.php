<?php define('ROOT', dirname(dirname(FILE)));
require_once(_ROOT . '/classes/Database.php');

require_once(ROOT . '/config/config.php');

class Contact extends Database
{
    protected $connection;

    public function __construct()
    {
        $this->connect();
        $this->connection = $this->getConnection();
    }
    public function ulozitSpravu($meno, $email)
    {
        $sql = "INSERT INTO contact_data (meno, email) VALUES (:meno, :email)";
        $statement = $this->connection->prepare($sql);
        try {
            $insert = $statement->execute(array(':meno' => $meno, ':email' => $email));
            http_response_code(200);
            return $insert;
        } catch (\Exception $exception) {
            http_response_code(500);
            return false;
        }
    }
}
