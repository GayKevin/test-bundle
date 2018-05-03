<?php


namespace Extellient\MailBundle\Provider\Mail;


use Extellient\MailBundle\Entity\MailInterface;

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