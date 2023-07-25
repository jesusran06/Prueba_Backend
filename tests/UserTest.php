<?php

use PHPUnit\Framework\TestCase;
use App\User;

class UserTest extends TestCase
{
    public function testUserGettersAndSetters()
    {
        $user = new User(1, 'John Doe', 'john@example.com', 'password123');

        $this->assertSame(1, $user->getId());
        $this->assertSame('John Doe', $user->getName());
        $this->assertSame('john@example.com', $user->getEmail());
        $this->assertSame('password123', $user->getPassword());

        $user->setId(2);
        $user->setName('Jane Doe');
        $user->setEmail('jane@example.com');
        $user->setPassword('newpassword');

        $this->assertSame(2, $user->getId());
        $this->assertSame('Jane Doe', $user->getName());
        $this->assertSame('jane@example.com', $user->getEmail());
        $this->assertSame('newpassword', $user->getPassword());
    }
}
