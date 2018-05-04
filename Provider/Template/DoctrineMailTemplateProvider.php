<?php

namespace Extellient\MailBundle\Provider\Template;

use Doctrine\ORM\EntityManagerInterface;
use Extellient\MailBundle\Entity\MailTemplate;
use Extellient\MailBundle\Entity\MailTemplateInterface;
use Extellient\MailBundle\Exception\MailTemplateNotFoundException;
use Extellient\MailBundle\Repository\MailRepository;
use Extellient\MailBundle\Repository\MailTemplateRepository;

/**
 * Class MailProviderDoctrine.
 */
class DoctrineMailTemplateProvider implements MailTemplateProviderInterface
{
    /**
     * @var MailTemplateRepository
     */
    private $mailTemplateRepository;

    /**
     * MailProviderDoctrine constructor.
     *
     * @param MailTemplateRepository $mailTemplateRepository
     */
    public function __construct(MailTemplateRepository $mailTemplateRepository)
    {
        $this->mailTemplateRepository = $mailTemplateRepository;
    }

    /**
     * @param $code
     *
     * @return MailTemplateInterface
     *
     * @throws MailTemplateNotFoundException
     */
    public function findOneTemplateByCode($code)
    {
        $mailTemplate = $this->mailTemplateRepository->findOneByCode($code);

        if (!$mailTemplate instanceof MailTemplateInterface) {
            throw new MailTemplateNotFoundException();
        }

        return $mailTemplate;
    }
}
