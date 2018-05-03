<?php

namespace Extellient\MailBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Extellient\MailBundle\Entity\MailTemplate;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class MailTemplateRepository
 * @package Extellient\MailBundle\Repository
 */
class MailTemplateRepository extends ServiceEntityRepository
{
    /**
     * MailTemplateRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MailTemplate::class);
    }

    /**
     * @param $code
     * @return MailTemplate
     */
    public function findOneByCode($code)
    {
        return parent::findOneByCode($code);
    }
}
