<?php


namespace Extellient\MailBundle\Services;


use Extellient\MailBundle\Entity\Mail;
use Extellient\MailBundle\Entity\MailInterface;
use Extellient\MailBundle\Provider\Mail\MailProviderInterface;

/**
 * Class MailService
 * @package Extellient\MailBundle\Services
 */
class Mailer
{
    /**
     * @var MailProviderInterface
     */
    private $mailProvider;
    /**
     * @var string
     */
    private $mailAddressFrom;
    /**
     * @var string
     */
    private $mailAliasFrom;
    /**
     * @var string
     */
    private $mailReplyTo;

    /**
     * MailService constructor.
     * @param MailProviderInterface $mailProvider
     * @param string $mailAddressFrom
     * @param string $mailAliasFrom
     * @param string $mailReplyTo
     */
    public function __construct(
        MailProviderInterface $mailProvider,
        $mailAddressFrom,
        $mailAliasFrom,
        $mailReplyTo
    ) {
        $this->mailProvider = $mailProvider;
        $this->mailAddressFrom = $mailAddressFrom;
        $this->mailAliasFrom = $mailAliasFrom;
        $this->mailReplyTo = $mailReplyTo;
    }

    /**
     * @param string $mailSubject
     * @param string $mailBody
     * @param array|string $recipients
     * @param array|string $attachements
     * @return MailInterface
     */
    public function createEmail($mailSubject, $mailBody, $recipients, $attachements)
    {
        if (!is_array($recipients)) {
            $recipients = [$recipients];
        }

        if (!is_array($attachements)) {
            $attachements = [$attachements];
        }

        $mail = new Mail($mailSubject, $mailBody, $recipients);
        $mail->setSenderAlias($this->mailAliasFrom);
        $mail->setSenderEmail($this->mailAddressFrom);
        $mail->setReplyToEmail($this->mailReplyTo);
        $mail->setAttachement($attachements);

        return $mail;
    }

    /**
     * Flush the Mail
     * @param $mails
     */
    public function save($mails)
    {
        $this->mailProvider->save($mails);
    }
}