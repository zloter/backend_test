<?php

namespace App\Command;

use App\Service\SequenceService;
use App\Service\ValidationService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SequenceCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:sequence';

    /**
     * @var SequenceService
     */
    private $sequenceService;

    /**
     * @var ValidationService
     */
    private $validationService;

    /**
     * SequenceCommand constructor.
     * @param string|null $name
     */
    public function __construct(string $name = null) {
        $this->sequenceService = new SequenceService();
        $this->validationService = new ValidationService();
        parent::__construct($name);
    }

    protected function configure() {
        $this
            ->setDescription('Finding out the biggest element in sequence')
            ->setHelp('It takes up to 10 numbers; accept standard input or list of arguments')
            ->addArgument(
                'lengths',
                InputArgument::IS_ARRAY,
                "How long should a sequence be (separate multiple numbers with a space)?\n
              You can also use standard input like this:    'cat test_cases.txt | ./bin/console app:sequence'
              In this case each number should be separate with an enter.\n In case of both inputs standard input take priority"
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $lengths = $this->parseStdin();
        empty($lengths) && $lengths = $input->getArgument('lengths');
        empty($lengths) && new InvalidArgumentException("There must be at least one length");
        $this->validate($lengths);
        foreach ($lengths as $length) {
            $output->write("For length " . $length . ": " . $this->sequenceService->findSequenceMax($length) . "\n");
        }
        return 0;
    }

    protected function parseStdin() {
        stream_set_blocking(STDIN, 0);
        $input = stream_get_contents(STDIN);
        $input = explode("\n", $input);
        if(end($input) === '') {
            array_pop($input);
        }
        return $input;
    }

    protected function validate(array $input):void {
        $errors = $this->validationService->validateAmount($input);
        empty($errors) && $errors = $this->validationService->validate($input);
        if (count($errors) > 0) {
            $errorsString = implode("\n", $errors);
            throw new \InvalidArgumentException($errorsString);
        }
    }
}