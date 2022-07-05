<?php

namespace App\Tests;

use Gitlab\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GitlabSelfHostedTest extends KernelTestCase
{
    public function testSomething(): void
    {
        self::bootKernel();

        $container = self::getContainer();
        $token = $container->getParameter('gitlab_access_token');
        $url = $container->getParameter('gitlab_base_url');

        $client = new Client();
        $client->setUrl($url);
        $client->authenticate($token, Client::AUTH_HTTP_TOKEN);

        $version = $client->version();

        self::assertArrayHasKey('version', $version->show());
    }
}
