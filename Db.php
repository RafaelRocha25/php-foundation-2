<?php
/**
 * Created by PhpStorm.
 * User: rafael
 * Date: 10/11/14
 * Time: 22:38
 */

class Db {

    private $host;
    private $dbname;
    private $user;
    private $password;

    public function __construct($host, $dbname, $user, $password) {
        $this->setHost($host);
        $this->setDbname($dbname);
        $this->setUser($user);
        $this->setPassword($password);
    }

    public function conectar() {
        try {
            return new PDO("mysql:host=".$this->getHost().";dbname=".$this->getDbname()."", $this->getUser(), $this->getPassword());
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function getDbname()
    {
        return $this->dbname;
    }

    /**
     * @param mixed $dbname
     */
    public function setDbname($dbname)
    {
        $this->dbname = $dbname;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

} 