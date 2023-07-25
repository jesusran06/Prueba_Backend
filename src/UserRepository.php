<?php

namespace App;

class UserRepository
{
    private $users = [];

    public function saveUser(User $user)
    {
        $this->users[$user->getId()] = $user;
    }

    public function getUserById($id)
    {
        if (isset($this->users[$id])) {
            return $this->users[$id];
        } else {
            throw new \RuntimeException("Usuario con ID $id no encontrado.");
        }
    }

    public function deleteUser($id)
    {
        if (!isset($this->users[$id])) {
            throw new \RuntimeException("Usuario con ID $id no encontrado.");
        }

        unset($this->users[$id]);
    }

    public function updateUser(User $user)
    {
        if (isset($this->users[$user->getId()])) {
            $this->users[$user->getId()] = $user;
        } else {
            throw new \RuntimeException("Usuario no encontrado.");
        }
    }
}
