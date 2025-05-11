<?php

return [

    'default' => env('FILESYSTEM_DISK', 'local'),

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        // Nouveau disk pour les documents d'actes de naissance
        'actes_naissance' => [
        'driver' => 'local',
        'root' => storage_path('app/public/documents/actes_naissance'),
        'url' => env('APP_URL').'/storage/documents/actes_naissance',
        'visibility' => 'public',
        'throw' => false,
        'report' => false,
        ],
        'actes_deces' => [
        'driver' => 'local',
        'root' => storage_path('app/public/documents/actes_deces'),
        'url' => env('APP_URL').'/storage/documents/actes_deces',
        'visibility' => 'public',
        'throw' => false,
        'report' => false,
        ],
        'actes_mariage' => [
        'driver' => 'local',
        'root' => storage_path('app/public/documents/actes_mariage'),
        'url' => env('APP_URL').'/storage/documents/actes_mariage',
        'visibility' => 'public',
        'throw' => false,
        'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

    ],

    'links' => [
        public_path('storage') => storage_path('app/public'),
        // Ajoutez ceci si vous voulez un accès public aux documents
        // public_path('storage/documents/actes_naissance') => storage_path('app/documents/actes_naissance'),
    ],

];