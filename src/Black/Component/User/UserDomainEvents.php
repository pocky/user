<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Black\Component\User;

/**
 * Class UserDomainEvents
 */
final class UserDomainEvents
{
    const USER_DOMAIN_LOGGED = 'black.user.domain.logged';

    const USER_DOMAIN_CREATED = 'black.user.domain.created';

    const USER_DOMAIN_UPDATED = 'black.user.domain.updated';

    const USER_DOMAIN_REGISTERED = 'black.user.domain.registered';

    const USER_DOMAIN_REMOVED = 'black.user.domain.removed';

    const USER_DOMAIN_ACTIVATED = 'black.user.domain.activate';

    const USER_DOMAIN_DEACTIVATED = 'black.user.domain.deactivate';

    const USER_DOMAIN_LOCKED = 'black.user.domain.locked';

    const USER_DOMAIN_UNLOCKED = 'black.user.domain.unlocked';
} 
