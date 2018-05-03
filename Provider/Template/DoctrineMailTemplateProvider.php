<?php


namespace Extellient\MailBundle\Provider\Template;


use Doctrine\ORM\EntityManagerInterface;
use Extellient\MailBundle\Entity\MailTemplate;
use Extellient\MailBundle\Entity\MailTemplateInterface;
use Extellient\MailBundle\Exception\MailTemplateNotFoundException;

/**
 * Class MailProviderDoctrine
 * @package Extellient\MailBundle\Services
 */
class DoctrineMailTemplateProvider implements MailTemplateProviderInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * MailProviderDoctrine constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param $code
     * @return MailTemplateInterface
     * @throws MailTemplateNotFoundException
     */
    public function findOneTemplateByCode($code)
    {
        $mailTemplate = $this->em
            ->getRepository(MailTemplate::class)
            ->findOneByCode($code)
        ;

        if (!$mailTemplate instanceof MailTemplateInterface) {
            throw new MailTemplateNotFoundException();
        }

        return $mailTemplate;
    }
}