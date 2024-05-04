<?php

namespace Quicktane\Core\Base;

use Illuminate\Database\Eloquent\Model as LaravelModel;

abstract class Model extends LaravelModel
{
    /**
     * Create a new instance of the Model.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('quicktane.database.table_prefix').$this->getTable());

        if ($connection = config('quicktane.database.connection', false)) {
            $this->setConnection($connection);
        }
    }
}
