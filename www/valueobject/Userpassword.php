<?php declare(strict_types=1);
namespace ValueObject;

class Userpassword
{
    private $Userpassword;
    public function __construct(string $Userpassword)
    {
        $this->Userpassword = $Userpassword;
    }
    public function toString() : string
    {
        return $this->Userpassword;
    }
}
