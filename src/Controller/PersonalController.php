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
    * @param  string $id
    */
    public function edit(string $id)
    {
        $person = $this->personalService->getPerson($id);

        return ($person) ? $this->respond($person) : $this->respondNotFound('Person not found!!');
    }

    /**
    * @Route("/personal/create", methods="POST")
    */
    public function create(Request $request)
    {
        $request = $this->transformJsonBody($request);

        //Validate data
        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        if (! $request->get('last_name')) {
            return $this->respondValidationError('Please provide a last name!');
        }

        if (! $request->get('email')) {
            return $this->respondValidationError('Please provide a email!');
        }

        if (! $request->get('identification')) {
            return $this->respondValidationError('Please provide a identification!');
        }

        $person = $this->personalService->addPerson(
            $request->get('name'), 
            $request->get('last_name'), 
            $request->get('email'), 
            $request->get('identification'));

        return $this->respond($person);
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

        //Validate data
        if (! $request->get('name')) {
            return $this->respondValidationError('Please provide a name!');
        }

        if (! $request->get('last_name')) {
            return $this->respondValidationError('Please provide a last name!');
        }

        if (! $request->get('email')) {
            return $this->respondValidationError('Please provide a email!');
        }

        if (! $request->get('identification')) {
            return $this->respondValidationError('Please provide a identification!');
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