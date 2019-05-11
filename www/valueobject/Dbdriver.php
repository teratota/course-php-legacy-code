<?php declare(strict_types=1);
namespace ValueObject;

class Dbdriver
{
    private $Dbdriver;
    public function __construct(string $Dbdriver)
    {
        $this->Dbdriver = $Dbdriver;
    }
    public function toString() : string
    {
        return $this->Dbdriver;
    }
}
