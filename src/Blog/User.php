<?php
namespace Vl\App\Blog;

use DateTimeImmutable;

class User
{
    public function __construct(
        private int $id,
        private Name $name,
        private string|null $email = null,
        private DateTimeImmutable|null $registeredOn = new DateTimeImmutable()
    ) {
    }
    public function id(): int
    {
        return $this->id;
    }
    public function name(): string
    {
        return $this->name;
    }

    public function __toString()
    {
        return 'User(' . $this->id . '): ' . $this->name . ', registered  ' . $this->registeredOn->format('Y-m-d') . '.';
    }
}
