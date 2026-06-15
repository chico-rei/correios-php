<?php

namespace ChicoRei\Packages\Correios\Tests;

use ChicoRei\Packages\Correios\Account;
use PHPUnit\Framework\TestCase;

class AccountTest extends TestCase
{
    public static function getTestData(): array
    {
        return [
            'username' => 'user@example.com',
            'password' => 's3cr3t',
            'contract' => '9912345678',
            'postcard' => '0067599079',
            'dr' => 72,
            'sandbox' => true,
        ];
    }

    public function testToArray()
    {
        $account = Account::create(static::getTestData());
        $this->assertSame(static::getTestData(), $account->toArray());
    }

    public function testDefaults()
    {
        $account = new Account();

        $this->assertNull($account->getUsername());
        $this->assertNull($account->getPassword());
        $this->assertNull($account->getContract());
        $this->assertNull($account->getPostcard());
        $this->assertNull($account->getDr());
        $this->assertFalse($account->isSandbox());
    }

    public function testFluentSettersAndTypes()
    {
        $account = new Account();

        $this->assertSame($account, $account->setUsername('user'));
        $this->assertSame($account, $account->setPassword('pass'));
        $this->assertSame($account, $account->setContract('123'));
        $this->assertSame($account, $account->setPostcard('456'));
        $this->assertSame($account, $account->setDr(7));
        $this->assertSame($account, $account->setSandbox(true));

        $this->assertSame('user', $account->getUsername());
        $this->assertSame('pass', $account->getPassword());
        $this->assertSame('123', $account->getContract());
        $this->assertSame('456', $account->getPostcard());
        $this->assertIsInt($account->getDr());
        $this->assertTrue($account->isSandbox());
    }
}
