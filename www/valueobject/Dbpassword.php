<?php declare(strict_types=1);
namespace ValueObject;
class Dbpassword
{
    private $Dbpassword;
    public function __construct(string $Dbpassword)
    {
        $this->Dbpassword = $Dbpassword;
    }
    public function toString() : string
    {
        return $this->Dbpassword;
    }
}