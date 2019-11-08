<?php
namespace App\Controller;

use App\Service\PersonalService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PersonalController extends ApiController
{
    /**
     * Personal Service
     * @var App\Service\PersonalService
     */
    private $personalService;

    public function __construct(PersonalService $personalService) 
    {
        $this->personalService = $personalService;
    }

    /**
    * @Route("/personal", methods="GET")
    */
    public function index()
    {
        $personal = $this->personalService->getAllPersonal();
        
        return $this->respond($personal);
    }

    /**
    * @Route("/personal/{id}", methods="GET")
    */
    public function view(string $id)
    {
        $person = $this->personalService->getPerson($id);

        return ($person) ? $this->respond($person) : $this->respondNotFound('Person not found!!');
    }
}