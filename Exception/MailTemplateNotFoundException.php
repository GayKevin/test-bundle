<?php


namespace Extellient\MailBundle\Exception;


use Throwable;

/**
 * Class MailTemplateNotFound
 * @package Extellient\MailBundle\Exception
 */
class MailTemplateNotFoundException extends \Exception
{
    /**
     * MailTemplateNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct('Mail Template not found');
    }
}