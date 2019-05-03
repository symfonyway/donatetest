<?php

namespace App\DataFixtures;

use App\Entity\Donation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class DonateFixture extends Fixture
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 50; $i++) {
            $this->makeItem($manager);
        }

        $manager->flush();
    }

    private function makeItem(ObjectManager $manager)
    {
        $donation = new Donation();

        $donation
            ->setName($this->faker->name)
            ->setEmail($this->faker->email)
            ->setAmount($this->faker->randomDigitNotNull)
            ->setMessage($this->faker->paragraph(1))
            ->setCreatedAt($this->faker->dateTimeBetween('first day of this month'))
        ;

        $manager->persist($donation);
    }
}