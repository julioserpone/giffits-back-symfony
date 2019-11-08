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
     * @param  string $id 
     * @return Personal|null
     */
    public function findPerson(string $id) : ?Personal
    {
        return $this->personalRepository->find($id);
    }

    /**
     * @param  string $id
     * @return array|null
     */
    public function getPerson(string $id) : ?array
    {
        $person = $this->personalRepository->find($id);

        return ($person) ? $this->personalRepository->transform($person) : null;
    }

    public function getAllPersonal() : array
    {
        return $this->personalRepository->transformAll();
    }

    /**
     * @param  string $id
     * @param  string $name
     * @param  string $last_name
     * @param  string $email
     * @param  string $identification 
     * @return array
     */
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

        return $this->personalRepository->transform($person_updated);
    }

    /**
     * @param  string $name
     * @param  string $last_name
     * @param  string $email
     * @param  string $identification 
     * @return array
     */
    public function addPerson(
        string $name, 
        string $last_name, 
        string $email, 
        string $identification) : array
    {
        $person = new Personal();
        $person->setName($name)
            ->setLastName($last_name)
            ->setEmail($email)
            ->setIdentification($identification);

        $new_person = $this->personalRepository->add($person);

        return $this->personalRepository->transform($new_person);
    }
    
    /**
     * @param  string $id
     * @return Personal|null
     */
    public function deletePerson($id) : ?Personal
    {   
        return $this->personalRepository->delete($this->personalRepository->find($id));
    }
}