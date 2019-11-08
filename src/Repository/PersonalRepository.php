<?php

namespace App\Repository;

use App\Entity\Personal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Personal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personal[]    findAll()
 * @method Personal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class PersonalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personal::class);
    }

    public function transform(Personal $personal)
    {
        return [
                'id'    => (int) $personal->getId(),
                'name' => (string) $personal->getName(),
                'last_name' => (string) $personal->getLastName(),
                'email' => (string) $personal->getEmail(),
                'identification' => (string) $personal->getIdentification()
        ];
    }

    public function transformAll()
    {
        $personal_list = $this->findAll();
        $personalArray = [];

        foreach ($personal_list as $personal) {
            $personalArray[] = $this->transform($personal);
        }

        return $personalArray;
    }

    public function update(string $id, Personal $data_updated)
    {
        $person = $this->find($id);

        $person->setName($data_updated->name)
            ->setLastName($data_updated->last_name)
            ->setEmail($data_updated->email)
            ->setIdentification($data_updated->identification);

        $this->_em->flush();
    }

    // /**
    //  * @return Personal[] Returns an array of Personal objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Personal
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
