<?php

namespace Vl\App\Blog\Repositories\UsersRepository;

use Vl\App\Blog\User;
use Vl\App\Blog\UUID;

interface UsersRepositoryInterface
{
	public function save(User $user): void;
	public function get(UUID $uuid): User;
	public function getByUsername(string $username): User;
}
