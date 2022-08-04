<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function switchToMysql()
    {
        $_ENV['DB_CONNECTION'] = 'mysql';

        $_ENV['DB_DATABASE'] = 'laravel_test';

        Config::set('database.connections.mysql.database', 'laravel_test');

        DB::setDefaultConnection('mysql');
    }

    protected function switchToSqlite()
    {
        $_ENV['DB_CONNECTION'] = 'sqlite';

        $_ENV['DB_DATABASE'] = ':memory:';

        Config::set('database.connections.mysql.database', ':memory:');

        DB::setDefaultConnection('sqlite');
    }
}
