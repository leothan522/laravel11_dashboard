<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function connect()
    {
        $firebase = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->withDatabaseUri(env("FIREBASE_DATABASE_URL"));

        return $firebase->createDatabase();
    }
}
