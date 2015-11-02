<?php

namespace Black\Component\User\Infrastructure\Persistence\ORM;

use Black\Component\Common\Infrastructure\Persistence\ORM\EntityRepository;
use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Domain\Model\UserReadRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\NoResultException;

/**
 * Class ReadRepository
 */
class ReadRepository extends EntityRepository implements UserReadRepository
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
            ->where('p.webPageId.value = :id')
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
        return $this->getQueryBuilder()->getQuery();
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
}
