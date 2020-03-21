<?php


namespace App\Controller;


use App\Services\SequenceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        parent::__construct();
    }

    /**
     * Show form for sequence
     *
     * @return Response
     */
    public function formAction() {
        return new Response('Response');
    }
}