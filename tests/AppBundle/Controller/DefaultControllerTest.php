<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('homepage', $client->getResponse()->getContent());
    }

    public function testOffers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cars');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Our Offers', $client->getResponse()->getContent());
        
        $link = $crawler->filter('a:contains("open")')->eq(0)->link();
        $crawler = $client->click($link);
        $this->assertContains('BMW', $crawler->filter('h1')->text());
    }
}