<?php


namespace App\Tests\Services;


use App\Services\SequenceService;
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
            [10, 4]
        ];
    }
}