<?php
/**
 * Database configuration
 *
 * @author David Carr - dave@daveismyname.com
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */


return array(
    // The PDO Fetch Style.
    'fetch' => PDO::FETCH_CLASS,

    // The Default Database Connection Name.
    'default' => 'mysql',

    // The Database Connections.
    'connections' => array(
        'sqlite' => array(
            'driver'    => 'sqlite',
            'database'  => APPDIR .'Storage' .DS .'database.sqlite',
            'prefix'    => '',
        ),
        'mysql' => array(
            'driver'    => 'mysql',
            'hostname'  => 'localhost',
            'database'  => 'africbaa_africanvalues',
            'username'  => 'africbaa_sibu',
            'password'  => 'TUESday1#',
            'prefix'    => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_bin',
        ),
        'pgsql' => array(
            'driver'   => 'pgsql',
            'host'     => 'localhost',
            'database' => 'afrcanvalues',
            'username' => 'root',
            'password' => 'root',
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
        ),
    ),
);
