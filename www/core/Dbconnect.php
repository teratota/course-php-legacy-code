<?php declare(strict_types=1);
namespace Core;

use Core\DbConnectinterface;
use ValueObject\Dbname;
use ValueObject\Dbpassword;
use ValueObject\Dbuser;
use ValueObject\Dbdriver;
use ValueObject\Dbhost;
use Exception;
use PDO;

class Dbconnect implements Dbconnectinterface
{
    private $pdo;
    public function __construct(Dbdriver $Dbdriver, Dbhost $Dbhost, Dbname $Dbname, Dbuser $Dbuser, Dbpassword $Dbpassword)
    {
        try {
            $this->pdo = new PDO($Dbdriver->toString() . ":host=" . $Dbhost->toString() . ";dbname=" . $Dbname->toString(), $Dbuser->toString(), $Dbpassword->toString());
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public function connect(): PDO
    {
        return $this->pdo;
    }
}
