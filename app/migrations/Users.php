<?php

namespace App\Migrations;

use App\Core\Interfaces\MigrationInterface;
use App\Core\Modules\DB;
use App\Core\Modules\Db\DBTableBuilder;

class Users implements MigrationInterface
{
    private const NAME = 'users';

    /**
     * Action to create migration
     *
     * @return void
     */
    public static function up()
    {
        DB::table(self::NAME)
            ->create(function (DBTableBuilder $table) {
                $table->field('id')->int()->increment();
                $table->field('firstname')->varchar();
                $table->field('lastname')->varchar();
                $table->field('email')->varchar();
                $table->field('phone')->int();
                $table->field('transpin')->varchar();
                $table->field('password')->varchar();
                $table->field('access_type')->int();
                $table->field('total_loan')->int();
            });
    }

    /**
     * Empty data in schema
     *
     * @return void
     */
    public static function empty()
    {
        DB::table(self::NAME)->truncate();
    }

    /**
     * Drop table
     *
     * @return void
     */
    public static function down()
    {
        DB::table(self::NAME)->drop();
    }
}