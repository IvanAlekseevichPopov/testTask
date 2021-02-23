<?php

declare(strict_types=1);

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Nelmio\Alice\FileLoaderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var FileLoaderInterface
     */
    private $loader;

    public function __construct(FileLoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    public function load(ObjectManager $manager): void
    {
        $collection = $this->loader->loadFile(__DIR__.'/fixtures.yaml');

        foreach ($collection->getObjects() as $item) {
            $manager->persist($item);
        }

        $manager->flush();
    }
}
