<?php

namespace Extellient\MailBundle\Tests\Services;

use Extellient\MailBundle\Entity\Mail;
use Extellient\MailBundle\Entity\MailTemplateInterface;
use Extellient\MailBundle\Services\Mailer;
use Extellient\MailBundle\Services\MailTemplating;
use Extellient\MailBundle\Template\MailTemplate;
use Extellient\MailBundle\Template\MailTemplateRenderer;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class MailTemplatingTest extends TestCase
{
    private $mailTemplating;
    private $mailTemplate;
    private $mailer;

    protected function setUp()
    {
        parent::setUp();
        $this->mailTemplate = $this->createMock(MailTemplate::class);
        $this->mailer = $this->createMock(Mailer::class);
        $this->mailTemplating = new MailTemplating($this->mailTemplate, $this->mailer);
    }

    public function testMailService()
    {
        $mailService = $this->mailTemplating->getMailService();
        $this->assertNotNull($mailService);
        $this->assertInstanceOf(Mailer::class, $mailService);
    }
}
