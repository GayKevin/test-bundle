<?php


namespace Extellient\MailBundle\Provider\Mail;


use Extellient\MailBundle\Entity\MailInterface;
use Extellient\MailBundle\Entity\MailTemplateInterface;
use Extellient\MailBundle\Exception\MailTemplateNotFoundException;

interface MailProviderInterface
{
    /**
     * @param $mails
     * @return void
     */
    public function save($mails);

    /**
     * @return MailInterface[]|null
     */
    public function findAllMail();
}