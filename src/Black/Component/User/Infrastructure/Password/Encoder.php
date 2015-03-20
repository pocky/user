<?php

namespace Black\Component\User\Infrastructure\Password;

/**
 * Class Encoder
 */
final class Encoder
{
    /**
     * @param $password
     *
     * @return bool|string
     */
    public static function encode($password)
    {
        $password = password_hash($password, PASSWORD_BCRYPT, [
            'cost' => 13,
        ]);

        return $password;
    }

    /**
     * @param $password
     * @param $hash
     *
     * @return bool
     */
    public function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }
}
