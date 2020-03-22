<?php


namespace App\Controller;


use App\Service\SequenceService;
use App\Service\ValidationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SequenceController extends AbstractController
{
    /**
     * @var SequenceService
     */
    private $sequenceService;

    /**
     * @var ValidationService
     */
    private $validationService;

    /**
     * SequenceController constructor.
     */
    public function __construct() {
        $this->sequenceService = new SequenceService();
        $this->validationService = new ValidationService();
    }

    /**
     * Show form for sequence
     *
     * @return Response
     */
    public function formAction() {
        return $this->render('sequence/form.html.twig', [
        ]);;
    }


    public function resultAction(Request $request) {
        $input = $request->request->get('input');
        $results = [];
        $status = 200;
        $errors = $this->validationService->validate($input);

        if (empty($errors)) {
            foreach($input as $item) {
                $result = $this->sequenceService->findSequenceMax($item);
                array_push($results, $result);
            }
        } else {
            $status = 422;
        }
        return $this->json([
            'results' => $results,
            'errors' =>$errors
        ], $status);
    }
}