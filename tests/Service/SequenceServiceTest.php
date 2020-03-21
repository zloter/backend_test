<?php


namespace App\Tests\Service;


use App\Service\SequenceService;
use PHPUnit\Framework\TestCase;

class SequenceServiceTest extends TestCase
{
    /**
     * @param int $input
     * @param int $output
     *
     * @dataProvider sequenceMaxProvider
     */
    public function testFindSequenceMax(int $input, int $output) {
        $service = new SequenceService();
        $result = $service->findSequenceMax($input);
        $this->assertEquals($output, $result);
    }

    /**
     * @return array
     */
    public function sequenceMaxProvider() {
        return [
            [5, 3],
            [10, 4],
            [0, 0],
            [1, 1],
            [99999, 2584]
        ];
    }
}