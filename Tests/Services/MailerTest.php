<?php

namespace Extellient\MailBundle\Tests\Services;

use Extellient\MailBundle\Provider\Mail\MailProviderInterface;
use Extellient\MailBundle\Services\Mailer;
use PHPUnit\Framework\TestCase;

/**
 * Class MailerTest.
 */
class MailerTest extends TestCase
{
    /**
     * @var MailProviderInterface
     */
    private $mailProviderInterface;
    /**
     * @var Mailer
     */
    private $mailer;

    protected function setUp()
    {
        parent::setUp();

        $this->mailProviderInterface = $this->createMock(MailProviderInterface::class);

        $this->mailer = new Mailer(
            $this->mailProviderInterface,
            'mailAddressFrom@test.com',
            'mailAliasFrom@test.com',
            'mailReplyTo@test.com'
        );
    }

    public function testCreateEmail()
    {
        $mail = $this->mailer->createEmail('subject', 'body', 'test@test.com');

        $this->assertEquals('subject', $mail->getSubject());
        $this->assertEquals('body', $mail->getBody());
        $this->assertEquals(['test@test.com'], $mail->getRecipient());
        $this->assertEquals('mailAddressFrom@test.com', $mail->getSenderEmail());
        $this->assertEquals('mailAliasFrom@test.com', $mail->getSenderAlias());
        $this->assertEquals('mailReplyTo@test.com', $mail->getReplyToEmail());
        $this->assertEquals([], $mail->getAttachement());

        $recip_array = $this->mailer->createEmail('subject',
            'body',
            ['test@test.com', 'test2@test.com'],
            'attachement'
        );

        $this->assertEquals(['test@test.com', 'test2@test.com'], $recip_array->getRecipient());
        $this->assertEquals(['attachement'], $recip_array->getAttachement());
    }
}
