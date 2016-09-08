<?php
/*
 * This file is part of the ${FILE_HEADER_PACKAGE}.
 *
 * ${FILE_HEADER_COPYRIGHT}
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Black\User\Infrastructure\Persistence;

use Black\Bridge\Doctrine\Common\Persistence\ORMRepository;
use Black\User\Domain\Entity\User;
use Black\User\Domain\Entity\UserId;
use Black\User\Domain\Repository\UserRepository;
use Doctrine\ORM\NoResultException;

/**
 * Class DoctrineORMRepository
 */
class DoctrineORMRepository extends ORMRepository implements UserRepository
{
    /**
     * @param mixed $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function find(UserId $id)
    {
        $query = $this->getQueryBuilder()
            ->where('p.userId.value = :id')
            ->setParameter('id', $id->getValue())
            ->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $exception) {
            return null;
        }
    }

    /**
     * @param $slug
     * @return mixed|null
     */
    public function findBySlug($slug)
    {
        $query = $this->getQueryBuilder()
            ->where('p.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $exception) {
            return null;
        }
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->getQueryBuilder()->getQuery()->execute();
    }

    /**
     * @param $username
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function loadUser($username)
    {
        $query = $this->getQueryBuilder()
            ->where('p.name = :name AND p.locked = false')
            ->setParameter('name', $username)
            ->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $exception) {
            return null;
        }
    }

    /**
     * @param User $user
     */
    public function add(User $user)
    {
        $this->manager->persist($user);
        $this->manager->flush();
    }

    /**
     * @param User $user
     */
    public function remove(User $user)
    {
        $this->manager->remove($user);
        $this->manager->flush();
    }
}
