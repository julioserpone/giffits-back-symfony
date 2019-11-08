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

    /**
     * @param  Personal $personal
     * @return array
     */
    public function transform(Personal $personal) : array
    {
        return [
                'id'    => (int) $personal->getId(),
                'name' => (string) $personal->getName(),
                'last_name' => (string) $personal->getLastName(),
                'email' => (string) $personal->getEmail(),
                'identification' => (string) $personal->getIdentification()
        ];
    }

    public function transformAll() : array
    {
        $personal_list = $this->findAll();
        $personalArray = [];

        foreach ($personal_list as $personal) {
            $personalArray[] = $this->transform($personal);
        }

        return $personalArray;
    }

    public function update(string $id, Personal $data_updated) : Personal
    {
        $person = $this->find($id);

        $person->setName($data_updated->getName())
            ->setLastName($data_updated->getLastName())
            ->setEmail($data_updated->getEmail())
            ->setIdentification($data_updated->getIdentification());

        $this->_em->flush();

        return $person;
    }

    public function add(Personal $person) : ?Personal
    {
        $this->_em->persist($person);
        $this->_em->flush();

        return $person;
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
