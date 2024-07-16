<?php

namespace App\Repositories;

use App\Models\StorageType;

class StorageTypeRepository
{
    private $_mStorageType;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->_mStorageType = new StorageType();
    }

    /**
     * ****** Get all storage types
     */
    public function getAll()
    {
        return $this->_mStorageType
            ->active()
            ->get();
    }
}
