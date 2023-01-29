<?php
namespace Vl\App\Blog;

/** @package Vl\App\Blog */
class Name
{
    /**
     * @param string $firstName 
     * @param string $lastName 
     * @return void 
     */
    public function __construct(
        private string $firstName,
        private string $lastName
    ) {
    }

    /** @return string  */
    public function firstName() {
        return $this->firstName;
    }

    /** @return string  */
    public function lastName() {
        return $this->lastName;
    }

    /** @return string  */
    public function __toString()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
