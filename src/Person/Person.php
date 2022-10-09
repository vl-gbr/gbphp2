<?php
namespace Vl\App\Person;

use DateTimeImmutable;
use Vl\App\Person_Name;

class Person
{
    public function __construct(
        private Person_Name $name,
        private DateTimeImmutable $registeredOn
    ) {
    }
    public function __toString()
    {
        return $this->name . ' (на сайте с ' . $this->registeredOn->format('Y-m-d') . ')';
    }
}
