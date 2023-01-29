<?php
namespace Vl\App\Blog;

use DateTimeImmutable;

class User
{
    private int $id;

    public function __construct(
        private UUID $uuid,
        private string $userName,
        private Name $name,
        private string|null $email = null,
        private DateTimeImmutable|null $registeredOn = new DateTimeImmutable()
    ) {
    }

    // DEPRECATED
    //public function id(): int
    //{
    //    return $this->id;
    //}

    public function name()
    {
        return $this->name;
    }

    public function userName(): string
    {
        return $this->userName;
    }

    public function uuid(): UUID
    {
        return $this->uuid;
    }


    public function __toString()
    {
        return "User($this->uuid): " . $this->name . ', registered  ' . $this->registeredOn->format('Y-m-d') . '.';
    }
}
