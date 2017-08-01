<?php

namespace App\Model;

use Nette\Database\UniqueConstraintViolationException;
use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;
use Nette\Security\Identity;
use Nette\Security\Passwords;

/**
 * Users management.
 */
class UserManager extends BaseManager implements IAuthenticator
{
    /** constants for manipulation with model */
    const
            TABLE_NAME = 'users',
            COLUMN_ID = 'user_id',
            COLUMN_NAME = 'username',
            COLUMN_PASSWORD_HASH = 'password',
            COLUMN_ROLE = 'role';

    /**
     * Logs user to the system
     * @param array $credentials Users name and password
     * @return Identity Identity of logged user
     * @throws AuthenticationException If there is error during logging to the system
     */
    public function authenticate(array $credentials)
    {
        list($username, $password) = $credentials;
        
        /** returns users details or false, if user does not exist */
        $user = $this->database->table(self::TABLE_NAME)->where(self::COLUMN_NAME, $username)->fetch();

        /** Verifies user */
        if (!$user)
        {
            throw new AuthenticationException('Uživatelské jméno je neplatné.', self::IDENTITY_NOT_FOUND);
        } 
        elseif (!Passwords::verify($password, $user[self::COLUMN_PASSWORD_HASH]))
        {
            throw new AuthenticationException('Heslo není správně.', self::INVALID_CREDENTIAL);
        } 
        elseif (Passwords::needsRehash($user[self::COLUMN_PASSWORD_HASH]))
        {
            $user->update([
                self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
            ]);
        }

        /** Prepares user data for use in the future */
        $userData = $user->toArray();
        unset($userData[self::COLUMN_PASSWORD_HASH]);
        /** returns users identity */ 
        return new Identity($user[self::COLUMN_ID], $user[self::COLUMN_ROLE], $userData);
    }

    /**
     * Registers user to the system
     * @param string $username user name
     * @param string $password password
     * @throws DuplicateNameException If user with user name already exists
     */
    public function register($username, $password)
    {
        try
        {
            $this->database->table(self::TABLE_NAME)->insert([
                self::COLUMN_NAME => $username,
                self::COLUMN_PASSWORD_HASH => Passwords::hash($password),
            ]);
        } catch (UniqueConstraintViolationException $e)
        {
            throw new DuplicateNameException;
        }
    }

}
/**
 * Exception used in register method, when used user name already exists
 * @package App\Model
 */
class DuplicateNameException extends AuthenticationException
{
    public function __construct()
    {
        parent::__construct();
        $this->message = 'Uživatel s tímto jménem je již zaregistrovaný. Zvolte prosím jiné uživatelské jméno.';
    }
}
