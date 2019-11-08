<?php 
namespace App\Service;

use App\Repository\PersonalRepository;
use Doctrine\ORM\EntityManager;

class PersonalService extends AbstractService
{
    private $personalRepository;

    public function __construct(PersonalRepository $personal_repository)
    {
        $this->personalRepository = $personal_repository;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getPersonal($personal_id)
    {
        return $this->personalRepository->find($personal_id);
    }

    public function getAllPersonal()
    {
        return $this->personalRepository->transformAll();
    }

    public function addPersonal()
    {
        return $this->personalRepository->save();
    }
    
    public function deletePersonal($id)
    {   
        return $this->personalRepository->delete($this->personalRepository->find($id));
    }
}