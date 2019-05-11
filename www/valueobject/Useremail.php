<?php declare(strict_types=1);
namespace ValueObject;

class Useremail
{
    private $Useremail;
    public function __construct(string $Useremail)
    {
        $this->Useremail = $Useremail;
    }
    public function toString() : string
    {
        return $this->Useremail;
    }
}
