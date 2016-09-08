User
===

A DDD/CQRS library for User Management (with his bundle for Symfony users)

<!--
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/eb624518-0c1e-47a6-a91b-73edf2244e2e/big.png)](https://insight.sensiolabs.com/projects/eb624518-0c1e-47a6-a91b-73edf2244e2e)

Installation
---

The recommended way to install User is through [Composer][2]:

```json
{
    "require": {
        "black/user": "@stable"
    }
}
```

__Protip:__ You should browse the [`black/user`][7] user to choose a stable version to use, avoid the `@stable` meta
constraint.

Usage
---
@todo

Symfony
---

Crea an User class and extends the lib user class:

```php

```

Add the bundle to your Kernel class

```
new Black\Bundle\UserBundle\BlackUserBundle(),
```

And add the configuration to your `config.yml`

```yml
# User Bundle
black_user:
    db_driver: orm
    user_class: Account\Domain\Entity\User
```

License
-------

User is released under the MIT License. See the bundled LICENSE file for details.

Contributing
------------

See CONTRIBUTING file.

Credits
-------

This README is heavily inspired by [Hateoas][1] library by the great [@willdurand][2]. This guy needs your [PR][3] for the
sake of the REST in PHP.

Alexandre "pocky" Balmes [alexandre@lablackroom.com][4]. Send me [Flattrs][5] if you love my work, [buy me gift][6] or hire me!

[1]: https://github.com/willdurand/Hateoas
[2]: https://github.com/willdurand
[3]: http://williamdurand.fr/2014/07/02/resting-with-symfony-sos/
[4]: mailto:alexandre@lablackroom.com
[5]: https://flattr.com/profile/alexandre.balmes
[6]: http://www.amazon.fr/registry/wishlist/3OR3EENRA5TSK
[7]: https://packagist.org/packages/black/user
