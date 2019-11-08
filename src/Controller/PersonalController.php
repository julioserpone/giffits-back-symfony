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
    * @Route("/personal/{id}/edit", methods="GET")
    */
    public function edit(string $id)
    {
        $person = $this->personalService->getPerson($id);

        return ($person) ? $this->respond($person) : $this->respondNotFound('Person not found!!');
    }

    /**
    * @Route("/personal/{id}/update", methods="PUT")
    */
    public function update(Request $request, string $id)
    {
        $person = $this->personalService->findPerson($id);
        $request = $this->transformJsonBody($request);

        if (!$person) 
        {
            return $this->respondNotFound('Person not found!!');
        }

        $person = $this->personalService->updatePerson(
            $id, 
            $request->get('name'), 
            $request->get('last_name'), 
            $request->get('email'), 
            $request->get('identification'));

        return $this->respond($person);
    }
}