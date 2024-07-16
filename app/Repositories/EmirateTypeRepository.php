<?php

namespace App\Repositories;

use App\Models\Emirate;

class EmirateTypeRepository
{
    private $_mEmirateType;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->_mEmirateType = new Emirate();
    }

    /**
     * ********* Get all active emirate Types *********
     */
    public function getAll()
    {
        return $this->_mEmirateType
            ->active()
            ->get();
    }
}
