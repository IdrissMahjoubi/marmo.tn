<?php

namespace FrontBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MailerControllerTest extends WebTestCase
{
    public function testSendmail()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/sendMail');
    }

}
