<?php declare(strict_types=1);
namespace Repository;

use Core\Dbconnect;
use Models\Users;

class Userrepository
{
    private $dbConnect;
    public function __construct(Dbconnect $Dbconnect)
    {
        $this->Dbconnect = $Dbconnect->connect();
    }
    /**
    * @param array $where the where clause
    * @param bool $object if it will return an array of results ou an object
    * @return mixed
    */
    public function getOneBy(array $where, bool $object = false)
    {
        $sqlWhere = [];
        foreach ($where as $key => $value) {
            $sqlWhere[] = $key . "=:" . $key;
        }
        $sql = " SELECT * FROM Users WHERE  " . implode(" AND ", $sqlWhere) . ";";
        $sqlquery = $this->dbConnect->prepare($sql);
        if ($object) {
            $this->getOneObject($sqlquery, $where);
        } else {
            $this->getOneArray($sqlquery, $where);
        }
    }
    public function getOneArray(\PDOStatement $sqlquery, array $where): array
    {
        $sqlquery->setFetchMode(PDO::FETCH_ASSOC);
        $sqlquery->execute($where);
        return $sqlquery->fetch();
    }
    public function getOneObject(\PDOStatement $sqlquery, array $where): object
    {
        $sqlquery->setFetchMode(PDO::FETCH_INTO, $this);
        $sqlquery->execute($where);
        return $sqlquery->fetch();
    }
    public function update(Users $users): void
    {
        $identity = $users->identity();
        $email = $users->email();
        $password = $users->password();
        $role = $users->role();
        $status = $users->status();
        $uid = $users->uid();
        $sql = "UPDATE `Users` SET `firstname`=:firstname,`lastname`= :lastname,`email`= :email,`pwd`= :pwd,`status`=:status,`role`=:role WHERE id = :id ";
        $sqlquery = $this->dbConnect->prepare($sql);
        $sqlquery->bindParam(':firstname', $identity->FirstName());
        $sqlquery->bindParam(':lastname', $identity->LastName());
        $sqlquery->bindParam(':email', $email->Email());
        $sqlquery->bindParam(':pwd', $password->toString());
        $sqlquery->bindParam(':role', $role);
        $sqlquery->bindParam(':status', $status);
        $sqlquery->bindParam(':id', $uid->toInt());
        $sqlquery->execute();
    }
    public function save(Users $users): void
    {
        $identity = $users->identity();
        $email = $users->email();
        $password = $users->password();
        $role = $users->role();
        $status = $users->status();
        $sql = "INSERT INTO Users (firstname, lastname, email, pwd, status, role) VALUES (:firstname, :lastname, :email, :pwd, :status, :role)";
        $sqlquery = $this->dbConnect->prepare($sql);
        $sqlquery->bindParam(':firstname', $identity->FirstName());
        $sqlquery->bindParam(':lastname', $identity->LastName());
        $sqlquery->bindParam(':email', $email->Email());
        $sqlquery->bindParam(':pwd', $password->toString());
        $sqlquery->bindParam(':role', $role);
        $sqlquery->bindParam(':status', $status);
        $sqlquery->execute();
    }
}
