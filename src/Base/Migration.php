<?php

namespace Quicktane\Core\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration as BaseMigration;
use Illuminate\Database\Schema\Blueprint;

abstract class Migration extends BaseMigration
{
    /**
     * Migration table prefix.
     */
    protected string $prefix = '';

    /**
     * Create a new instance of the migration.
     */
    public function __construct()
    {
        $this->prefix = config('quicktane.database.table_prefix');
    }

    protected function scheduling(Blueprint $table)
    {
        $table->boolean('enabled')->default(false)->index();
        $table->timestamp('starts_at')->nullable()->index();
        $table->timestamp('ends_at')->nullable()->index();
    }

    protected function dimensions(Blueprint $table)
    {
        /** @var Blueprint $this */
        $columns = ['length', 'width', 'height', 'weight', 'volume'];
        foreach ($columns as $column) {
            $this->decimal("{$column}_value", 10, 4)->nullable()->index();
            $this->string("{$column}_unit")->nullable();
        }
    }

    protected function userForeignKey(Blueprint $table, string $fieldName = 'user_id', bool $nullable = false)
    {
        $userModelClass = config('auth.providers.users.model');
        /** @var Model $userModel */
        $userModel = new $userModelClass();

        $usersTable = $userModel->getTable();

        $type = config('quicktane.database.users_id_type', 'bigint');

        if ($type == 'uuid') {
            return $table->foreignUuId($fieldName)->nullable($nullable)->constrained($usersTable);
        }

        if ($type == 'int') {
            $table->unsignedInteger($fieldName)->nullable($nullable);

            return $table->foreign($fieldName)->references($userModel->getKeyName())->on($usersTable);
        }

        if ($type === 'bigint') {
            return $table->foreignId($fieldName)->nullable($nullable)->constrained($usersTable);
        }
    }
}
