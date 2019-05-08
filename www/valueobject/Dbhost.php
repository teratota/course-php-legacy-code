<?php declare(strict_types=1);
namespace ValueObject;
class Dbhost
{
    private $Dbhost;
    public function __construct(string $Dbhost)
    {
        $this->Dbhost = $Dbhost;
    }
    public function toString() : string
    {
        return $this->Dbhost;
    }
}