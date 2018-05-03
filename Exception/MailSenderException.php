<?php


namespace Extellient\MailBundle\Exception;

/**
 * Class SenderException
 * @package Extellient\MailBundle\Exception
 */
class MailSenderException extends \Exception
{
    /**
     * MailTemplateNotFoundException constructor.
     * @param $recipients
     */
    public function __construct($recipients = [])
    {
        parent::__construct('Mail not send');
    }
}