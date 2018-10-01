<?php

namespace app\tests;


use app\models\entities\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
  public function testGetPassword(){
    $this->assertTrue(true);
    return '1234';
  }
  
  /**
   * @depends testGetPassword
   */
  public function testCreateUser($password){
    $user = new User(
      null,
      'firstName',
      'last name',
      'login',
      $password);
    $this->assertInstanceOf(User::class, $user);
    return $user;
  }
  
  /**
   * @depends testGetPassword
   * @depends testCreateUser
   */
  public function testCheckPassword($password, $user){
    $this->assertTrue($user->checkPassword($password));
    $this->assertFalse($user->checkPassword('12345'));
  }
}