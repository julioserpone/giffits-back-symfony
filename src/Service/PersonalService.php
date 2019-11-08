<?php 
namespace App\Service;

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

    public function getPerson($person_id)
    {
        $person = $this->personalRepository->find($person_id);

        return ($person) ? $this->personalRepository->transform($person) : null;
    }

    public function getAllPersonal()
    {
        return $this->personalRepository->transformAll();
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