<?php

namespace WCSCoavBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReviewControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/review');
    }

    public function testNew()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/review/new');
    }

}
