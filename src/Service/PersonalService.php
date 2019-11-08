<?php 
namespace App\Service;

use App\Entity\Personal;
use App\Repository\PersonalRepository;
use Doctrine\ORM\EntityManager;

class PersonalService
{
    /**
     * Personal Repository
     * @var App\Repository\PersonalRepository
     */
    private $personalRepository;

    public function __construct(PersonalRepository $personal_repository)
    {
        $this->personalRepository = $personal_repository;
    }

    /**
     * @param  string $person_id 
     * @return Personal|null
     */
    public function findPerson(string $person_id) : ?Personal
    {
        return $this->personalRepository->find($person_id);
    }

    /**
     * @param  string $person_id
     * @return array|null
     */
    public function getPerson(string $person_id) : ?array
    {
        $person = $this->personalRepository->find($person_id);

        return ($person) ? $this->personalRepository->transform($person) : null;
    }

    public function getAllPersonal() : array
    {
        return $this->personalRepository->transformAll();
    }

    public function updatePerson(
        string $id, 
        string $name, 
        string $last_name, 
        string $email, 
        string $identification)
    {
        $person = new Personal();
        $person->setName($name)
            ->setLastName($last_name)
            ->setEmail($email)
            ->setIdentification($identification);

        $person_updated = $this->personalRepository->update($id, $person);
    }

    public function addPerson()
    {
        return $this->personalRepository->save();
    }
    
    public function deletePerson($id)
    {   
        return $this->personalRepository->delete($this->personalRepository->find($id));
    }
}