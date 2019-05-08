<?php declare(strict_types=1);
namespace ValueObject;
class Dbname
{
    private $Dbname;
    public function __construct(string $Dbname)
    {
        $this->Dbname = $Dbname;
    }
    public function toString() : string
    {
        return $this->Dbname;
    }
}