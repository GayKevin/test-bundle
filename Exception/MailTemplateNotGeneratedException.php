<?php


namespace Extellient\MailBundle\Exception;


use Throwable;

/**
 * Class MailTemplateNotFound
 * @package Extellient\MailBundle\Exception
 */
class MailTemplateNotGeneratedException extends \Exception
{
    /**
     * MailTemplateNotGeneratedException constructor.
     * @param \Exception $e
     */
    public function __construct(\Exception $e)
    {
        parent::__construct(sprintf('Mail Template has not been generated(%s)', $e->getMessage()), $e->getCode(), $e);
    }
}