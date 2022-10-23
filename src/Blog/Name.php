<?php
namespace Vl\App\Blog;
class Name
{
    public function __construct(
        private string $firstName,
        private string $lastName
    ) {
    }
    public function firstName() {
        return $this->firstName;
    }
    public function lastName() {
        return $this->lastName;
    }
    public function __toString()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
