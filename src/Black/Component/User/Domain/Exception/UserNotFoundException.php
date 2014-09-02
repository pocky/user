<?php

/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\User\Domain\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class UserNotFoundException
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class UserNotFoundException extends NotFoundHttpException
{
    /**
     * @param string     $message
     * @param \Exception $previous
     * @param int        $code
     */
    public function __construct($message = "User Not Found!", \Exception $previous = null, $code = 0)
    {
        parent::__construct($message, $previous, $code);
    }
}
