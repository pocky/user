<?php

namespace Black\Component\User\Infrastructure\Password;

/**
 * Class Encoder
 *
 * @author Alexandre Balmes <${COPYRIGHT_NAME}>
 * @license ${COPYRIGHT_LICENCE}
 */
final class Encoder
{
    /**
     * @param $password
     * @param $salt
     *
     * @return bool|string
     */
    public static function encode($password, $salt)
    {
        $password = password_hash($password, PASSWORD_BCRYPT, [
            'cost' => 13,
            'salt' => $salt,
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
