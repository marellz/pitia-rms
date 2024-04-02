<?php

namespace App\Service;

use Exception;
use Illuminate\Support\Collection;

class QuantityService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function updateUnits(Collection $validated, int $currentUnits) : int
    {
        $units = 0;
        $type = $validated->get('type');
        if ($type === 'addition') {
            $units = $validated->get('units') + $currentUnits;
        } else if ($type === 'deduction') {
            if ($currentUnits < $validated->get('units')) {
                throw new Exception("Units available are too few");
            }
            $units = $currentUnits - $validated->get('units');
        }

        return $units;
    }
}
