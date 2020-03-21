<?php


namespace App\Service;


class SequenceService
{
    /**
     * @param int $number Length of sequence
     * @return array Full sequence
     */
    public function createSequence(int $number) : array {
        $seq = [0];
        if ($number > 0) {
            array_push($seq,1);
        }
        for ($iterator = 2; $iterator <= $number; $iterator++) {
            if ($iterator % 2 === 0) {
                $item = $seq[$iterator/2];
                array_push($seq, $item);
            } else {
                $item = $seq[($iterator-1)/2] + $seq[($iterator+1)/2];
                array_push($seq, $item);
            }
        }
        return $seq;
    }

    /**
     * @param int $number Length of sequence
     * @return int Max value in sequence
     */
    public function findSequenceMax(int $number) : int {
        return max($this->createSequence($number));
    }

}