<?php declare(strict_types=1);
namespace ValueObject;
class Dbuser
{
    private $Dbuser;
    public function __construct(string $Dbuser)
    {
        $this->Dbuser = $Dbuser;
    }
    public function toString() : string
    {
        return $this->Dbuser;
    }
}