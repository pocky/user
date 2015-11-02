<?php

namespace Black\Component\User\Infrastructure\Persistence\MongoDB;

use Black\Component\Common\Infrastructure\Persistence\MongoDB\DocumentRepository;
use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Domain\Model\UserReadRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\NoResultException;

/**
 * Class ReadRepository
 */
class ReadRepository extends DocumentRepository implements UserReadRepository
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
            ->field('userId.value')->equals($id->getValue())
            ->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $exception) {
            return null;
        }
    }

    /**
     * @param $slug
     * @return null
     */
    public function findBySlug($slug)
    {
        $query = $this->getQueryBuilder()
            ->field('slug')->equals($slug)
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
            ->field('name')->equals($username)
            ->field('locked')->equals(false)
            ->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $exception) {
            return null;
        }
    }
}
