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
        $query = $this->dbConnect->prepare($sql);
        if ($object) {
            $this->getOneObject($query, $where);
        } else {
            $this->getOneArray($query, $where);
        }
    }
    public function getOneArray(\PDOStatement $query, array $where): array
    {
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute($where);
        return $query->fetch();
    }
    public function getOneObject(\PDOStatement $query, array $where): object
    {
        $query->setFetchMode(PDO::FETCH_INTO, $this);
        $query->execute($where);
        return $query->fetch();
    }
    public function save(Users $users): void
    {
        $identity = $users->identity();
        $email = $users->email();
        $password = $users->password();
        $role = $users->role();
        $status = $users->status();
        $sql = "INSERT INTO Users (firstname, lastname, email, pwd, status, role) VALUES (:firstname, :lastname, :email, :pwd, :status, :role)";
        $query = $this->dbConnect->prepare($sql);
        $query->bindParam(':firstname', $identity->FirstName());
        $query->bindParam(':lastname', $identity->LastName());
        $query->bindParam(':email', $email->Email());
        $query->bindParam(':pwd', $password->toString());
        $query->bindParam(':role', $role);
        $query->bindParam(':status', $status);
        $query->execute();
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
        $query = $this->dbConnect->prepare($sql);
        $query->bindParam(':firstname', $identity->FirstName());
        $query->bindParam(':lastname', $identity->LastName());
        $query->bindParam(':email', $email->Email());
        $query->bindParam(':pwd', $password->toString());
        $query->bindParam(':role', $role);
        $query->bindParam(':status', $status);
        $query->bindParam(':id', $uid->toInt());
        $query->execute();
    }
}
