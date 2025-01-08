<?php

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    private $dbMock;

    protected function setUp(): void
    {
        // Mock de la connexion à la base de données
        $this->dbMock = $this->createMock(PDO::class);
        $stmtMock = $this->createMock(PDOStatement::class);

        // Stub pour getDBConnection()
        User::setDBConnection(function () {
            return $this->dbMock;
        });

        // Stub des méthodes PDO
        $this->dbMock->method('prepare')->willReturn($stmtMock);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('fetch')->willReturn(['user_id' => 1, 'email' => 'test@example.com']);
        $stmtMock->method('fetchAll')->willReturn([
            ['user_id' => 1, 'email' => 'test1@example.com'],
            ['user_id' => 2, 'email' => 'test2@example.com']
        ]);
    }

    public function testFindByEmail()
    {
        $email = 'lixeg54497@lofiey.com';
        $result = User::findByEmail($email);

        $this->assertIsArray($result);
        $this->assertEquals('lixeg54497@lofiey.com', $result['email']);
    }

    public function testFindById()
    {
        $userId = 22;
        $result = User::findById($userId);

        $this->assertIsArray($result);
        $this->assertEquals(22, $result['user_id']);
    }

    public function testGetAllUsers()
    {
        $result = User::getAllUsers();

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }
}
