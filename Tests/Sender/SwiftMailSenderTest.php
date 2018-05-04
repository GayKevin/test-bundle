<?php
/**
 * Created by Extellient.
 * User: tchapuis
 * Date: 04/05/2018
 * Time: 11:19
 */

namespace Extellient\MailBundle\Tests\Sender;

use Extellient\MailBundle\Entity\Mail;
use Extellient\MailBundle\Provider\Mail\MailProviderInterface;
use Extellient\MailBundle\Sender\SwiftMailSender;
use PHPUnit\Framework\TestCase;

class SwiftMailSenderTest extends TestCase
{
    private $mailer;
    private $mailEntityProvider;
    private $swiftMailerSender;

    protected function setUp()
    {
        parent::setUp();
        $this->mailer = $this->createMock(\Swift_Mailer::class);
        $this->mailEntityProvider = $this->createMock(MailProviderInterface::class);
        $this->swiftMailerSender = new SwiftMailSender($this->mailer, $this->mailEntityProvider);
    }


    public function testInitSwiftMessage()
    {
        $mail = new Mail('subject', 'body', ['recipient@test.com']);
        $mail->setSenderEmail('sender@test.com');
        $mail->setSenderAlias('senderAlias');

        $message = $this->swiftMailerSender->initSwiftMessage($mail);

        $this->assertInstanceOf(\Swift_Message::class, $message);
        $this->assertEquals('subject', $message->getSubject());
        $this->assertEquals('body', $message->getBody());
        $this->assertEquals(['recipient@test.com' => null], $message->getTo());
        $this->assertEquals(['sender@test.com' => 'senderAlias'], $message->getFrom());

    }

    public function testSendWithSuccess()
    {
        $mail = new Mail('subject', 'body', ['recipient@test.com']);
        $mail->setSenderEmail('sender@test.com');
        $mail->setSenderAlias('senderAlias');

        $this->mailer->expects($this->once())->method('send')->willReturn(1);

        $sent = $this->swiftMailerSender->send($mail);
        $this->assertEquals(1, $sent);
    }

//    public function testSendWithException()
//    {
//        $mail = new Mail('subject', 'body', ['recipient@test.com']);
//        $mail->setSenderEmail('sender@test.com');
//        $mail->setSenderAlias('senderAlias');
//
//        $this->mailer->expects($this->once())->method('send')->willReturn(1);
//
//        $sent = $this->swiftMailerSender->send($mail);
//        $this->assertEquals(1, $sent);
//    }

    public function testSendWithoutSenderEmail()
    {
        $mail = new Mail('subject', 'body', ['recipient@test.com']);
        $this->expectException(\Swift_RfcComplianceException::class);
        $sent = $this->swiftMailerSender->send($mail);
    }
}
