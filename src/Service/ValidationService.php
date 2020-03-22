<?php


namespace App\Service;


class ValidationService
{
    /**
     * @var int min sequence length
     */
    const MIN_VALUE = 1;

    /**
     * @var int max sequence length
     */
    const MAX_VALUE = 99999;

    /**
     * @var int max sequence length
     */
    const MAX_COUNT = 10;

    /**
     * @var array Error messages
     */
    const ERROR_MESSAGES = [
        'empty' => 'Length cannot be empty',
        'numeric' => "Length must be numeric",
        'min_value' => "Length must be greater than 0",
        'max_value' => "Length must be smaller than 10 000",
        'max_count' => '"There cannot be more than 10 lengths"'
    ];

    public function validate($input) : array {
        $errors = [];
        foreach($input as $key => $item) {
            if (empty($item)) {
                $errors[$key] = $this::ERROR_MESSAGES['empty'];
            } else if (!is_numeric($item)) {
                $errors[$key] = $this::ERROR_MESSAGES['numeric'];
            } else if ($item < $this::MIN_VALUE) {
                $errors[$key] = $this::ERROR_MESSAGES['min_value'];
            } else if ($item > $this::MAX_VALUE) {
                $errors[$key] = $this::ERROR_MESSAGES['max_value'];
            }
        }
        return $errors;
    }

    public function validateAmount($input) {
        $errors = [];
        if (count($input) > $this::MAX_COUNT) {
            $errors[] = $this::ERROR_MESSAGES['max_count'];
        }
        return $errors;
    }
}