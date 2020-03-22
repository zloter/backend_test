<?php


namespace App\Controller;


use App\Service\SequenceService;
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
     * SequenceController constructor.
     */
    public function __construct()
    {
        $this->sequenceService = new SequenceService();
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
        $errors = [];
        // TODO:  improve validation
        foreach($input as $item) {
            if (!is_numeric($item) || $item == 0) {
                array_push($errors, 'Długość ciągu musi być liczbą całkowitą dodatnią');
            }
            break;
        }

        if (empty($errors)) {
            foreach($input as $item) {
                $result = $this->sequenceService->findSequenceMax($item);
                array_push($results, $result);
            }
        }
        return $this->render('sequence/result.html.twig', [
            'results' => $results,
            'errors' => $errors
        ]);;
    }
}