<?php

use PHPUnit\Framework\TestCase;
use App\User;
use App\UserRepository;

class UserRepositoryTest extends TestCase
{
    public function testSaveAndGetUserById()
    {
        $userRepository = new UserRepository();
        // Creamos dos usuarios y los guardamos en el repositorio
        $user1 = new User(1, 'John Doe', 'john@example.com', 'password123');
        $userRepository->saveUser($user1);

        $user2 = new User(2, 'Jane Doe', 'jane@example.com', 'newpassword');
        $userRepository->saveUser($user2);

        // Obtenemos los IDs de los usuarios creados
        $userId1 = $user1->getId();
        $userId2 = $user2->getId();

        $this->assertEquals($user1, $userRepository->getUserById($userId1));
        $this->assertEquals($user2, $userRepository->getUserById($userId2));
    }

    public function testUpdateUser()
    {
        $userRepository = new UserRepository();

        $user = new User(1, 'John Doe', 'john@example.com', 'password123');
        $userRepository->saveUser($user);

        // Actualizar el usuario
        $user->setName('Jane Doe');
        $user->setEmail('jane@example.com');
        $user->setPassword('newpassword');
        $userRepository->updateUser($user);
        $userId = $user->getId();
        $this->assertSame('Jane Doe', $userRepository->getUserById($userId)->getName());
        $this->assertSame('jane@example.com', $userRepository->getUserById($userId)->getEmail());
        $this->assertSame('newpassword', $userRepository->getUserById($userId)->getPassword());
    }

    public function testGetUserByIdNotFound()
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Usuario con ID 123 no encontrado.');
        $userRepository = new UserRepository();
        $userRepository->getUserById(123);
    }

    public function testDeleteUser()
    {
        $user = new User(1, 'John Doe', 'john@example.com', 'password');
        $userRepository = new UserRepository();
        $userRepository->saveUser($user);
        $userId = $user->getId();
        $this->assertNotNull($userRepository->getUserById($userId));
        $userRepository->deleteUser($userId);
        $this->expectException(\RuntimeException::class);
        $userRepository->getUserById($userId);
    }

    public function testUpdateUserWhenUserNotFound()
    {
        $user = new User(1, 'John Doe', 'john@example.com', 'password');
        $userRepository = new UserRepository();
        $userRepository->saveUser($user);
        $userId = $user->getId();
        $this->assertNotNull($userRepository->getUserById($userId));
        $updatedUser = new User(123, 'Updated Name', 'updated@example.com', 'newpassword');
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage("Usuario no encontrado.");
        $userRepository->updateUser($updatedUser);
    }
}
