<?php declare(strict_types=1);
namespace ValueObject;

class Useridentity
{
    private $Useremail;
    public function __construct(string $Useridentity)
    {
        $this->Useridentity = $Useridentity;
    }
    public function toString() : string
    {
        return $this->Useridentity;
    }
}
