<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactController extends WebTestCase
{
    /**
     * Tests the add contact page
     * 1. Tests if page shows without errors
     * 2. Tests if correct error is shown on Invalid Phone Number
     * 3. Page is redirected to main list on succesful submission of data and shows success message
     */
    public function testAddContactInvalidNumber()
    {
        $client    = static::createClient();
        $csrfToken = $client->getContainer()->get('security.csrf.token_manager')->getToken('contact_type');
        $client->request('GET', '/');
        //1. Test if page to add contact is accessible
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        //post data with invalid number
        $crawler = $client->request('POST', '/phone_book/contact/add', array(
            'contact' => array(
                'firstName' => 'Vo',
                'lastName'  => 'Duc',
                'phoneType' => 1,
                'number'    => '514706kjj',
                '_token'    => $csrfToken,
            ),
        ));

        //2. Tests if correct error is shown on Invalid Phone Number
        $this->assertCount(1, $crawler->filter('form:contains("Provide a valid CA number")'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        //post correct data and check if redirects to home page
        $client    = static::createClient();
        $csrfToken = $client->getContainer()->get('security.csrf.token_manager')->getToken('contact_type');
        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $crawler = $client->request('POST', '/phone_book/contact/add', array(
            'contact' => array(
                'firstName' => 'Vo',
                'lastName'  => 'Duc',
                'phoneType' => 2,
                'number'    => '5147062833',
                '_token'    => $csrfToken,
            ),
        ));

        // 3. Page is redirected to main list on succesful submission of data and shows success message
        $this->assertEquals(302, $client->getResponse()->getStatusCode(), "Correct redirect to home page");
        $crawler = $client->followRedirect();
        $this->assertCount(1, $crawler->filter('html:contains("A new contact has been added!")'));
    }


    /**
     * Tests the index action (listing) page of ContactController
     */
    public function testIndex()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertCount(1, $crawler->filter('html:contains("Last Name")'));//cehck if it has the table column
        $this->assertCount(1, $crawler->filter('html:contains("Duc")'));//check contact added in last test
    }
}
