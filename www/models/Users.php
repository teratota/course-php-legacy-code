<?php declare(strict_types=1);
namespace Models;

use ValueObject\Useremail;
use ValueObject\Useridentity;
use ValueObject\Userpassword;

class Users
{
    private $uid;
    private $useridentity;
    private $useremail;
    private $userpassword;
    private $role;
    private $status;
    public function __construct(Useridentity $useridentity, Useremail $useremail, Userpassword $userpassword)
    {
        $this->useridentity = $useridentity;
        $this->useremail = $useremail;
        $this->userpassword = $userpassword;
        $this->role = 1;
        $this->status = 0;
    }
    public function identity(): UserIdentity
    {
        return $this->useridentity;
    }
    public function email(): UserEmail
    {
        return $this->useremail;
    }
    public function password(): UserPassword
    {
        return $this->userpassword;
    }
    public function role(): int
    {
        return $this->role;
    }
    public function status() : int
    {
        return $this->status;
    }
}
