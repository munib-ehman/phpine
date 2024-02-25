<?php

declare(strict_types=1);

namespace APP\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{

    public function __construct(private Database $db)
    {
    }
    public function isEmailTaken(string $email)
    {
        $emailCount = $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email= :email",
            ['email' => $email]
        )->count();

        if ($emailCount > 0) {
            throw new ValidationException(['errror' => "Email already taken"]);
        }
    }

    public function register(array $userData)
    {
        $password = password_hash($userData['password'], PASSWORD_BCRYPT, ['cost' => 12]);
        $this->db->query(
            "INSERT INTO users (email,password,age,country,social_media_url)
            VALUES (:email,:password,:age,:country,:social_media_url)
            ",
            [
                'email' => $userData['email'],
                'password' => $password,
                'age' => $userData['age'],
                'country' => $userData['country'],
                'social_media_url' => $userData['socialMediaUrl']
            ]
        );
    }
}
