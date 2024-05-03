<?php

namespace Quicktane\Core\Base;

use Illuminate\Database\Eloquent\Model;
use Lunar\Base\Traits\HasModelExtending;

abstract class BaseModel extends Model
{
//    use HasModelExtending;

    /**
     * Create a new instance of the Model.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('database.table_prefix') . $this->getTable());

//        if ($connection = config('database.connection', false)) {
//            $this->setConnection('mysql1');
//            $this->refresh();
//        }
    }
}
