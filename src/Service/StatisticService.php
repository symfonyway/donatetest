<?php

namespace App\Service;

use App\Entity\Donation;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class StatisticService
 * @package App\Service
 */
class StatisticService
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * StatisticService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return array
     */
    public function getDashboardStats()
    {
        $repository = $this->em->getRepository(Donation::class);

        $data = ['items' => [], 'total' => 0];
        $items = $repository->findAll();

        /** @var Donation $item */
        foreach ($items as $item) {
            $key = $item->getCreatedAt()->format('Y-m-d');

            if (!isset($data['items'][$key])) {
                $data['items'][$key] = 0;
            }

            $data['items'][$key] += $item->getAmount();
            $data['total'] += $item->getAmount();
        }

        ksort($data['items']);

        $data['max_donor'] = $repository->getMaxDonor();
        $data['month'] = $repository->getMonthMount();

        return $data;
    }
}
