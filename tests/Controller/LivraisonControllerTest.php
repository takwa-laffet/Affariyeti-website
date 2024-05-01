<?php

namespace App\Test\Controller;

use App\Entity\Livraison;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LivraisonControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/livraison/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Livraison::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Livraison index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'livraison[adresselivraison]' => 'Testing',
            'livraison[datecommande]' => 'Testing',
            'livraison[datelivraison]' => 'Testing',
            'livraison[statuslivraison]' => 'Testing',
            'livraison[latitude]' => 'Testing',
            'livraison[longitude]' => 'Testing',
            'livraison[iddepot]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Livraison();
        $fixture->setAdresselivraison('My Title');
        $fixture->setDatecommande('My Title');
        $fixture->setDatelivraison('My Title');
        $fixture->setStatuslivraison('My Title');
        $fixture->setLatitude('My Title');
        $fixture->setLongitude('My Title');
        $fixture->setIddepot('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Livraison');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Livraison();
        $fixture->setAdresselivraison('Value');
        $fixture->setDatecommande('Value');
        $fixture->setDatelivraison('Value');
        $fixture->setStatuslivraison('Value');
        $fixture->setLatitude('Value');
        $fixture->setLongitude('Value');
        $fixture->setIddepot('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'livraison[adresselivraison]' => 'Something New',
            'livraison[datecommande]' => 'Something New',
            'livraison[datelivraison]' => 'Something New',
            'livraison[statuslivraison]' => 'Something New',
            'livraison[latitude]' => 'Something New',
            'livraison[longitude]' => 'Something New',
            'livraison[iddepot]' => 'Something New',
        ]);

        self::assertResponseRedirects('/livraison/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getAdresselivraison());
        self::assertSame('Something New', $fixture[0]->getDatecommande());
        self::assertSame('Something New', $fixture[0]->getDatelivraison());
        self::assertSame('Something New', $fixture[0]->getStatuslivraison());
        self::assertSame('Something New', $fixture[0]->getLatitude());
        self::assertSame('Something New', $fixture[0]->getLongitude());
        self::assertSame('Something New', $fixture[0]->getIddepot());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Livraison();
        $fixture->setAdresselivraison('Value');
        $fixture->setDatecommande('Value');
        $fixture->setDatelivraison('Value');
        $fixture->setStatuslivraison('Value');
        $fixture->setLatitude('Value');
        $fixture->setLongitude('Value');
        $fixture->setIddepot('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/livraison/');
        self::assertSame(0, $this->repository->count([]));
    }
}
