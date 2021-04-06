<?php

return [
    'endpoint' => [
        'localhost' => [
            'host' => env('SOLRDB_HOST', '127.0.0.1'),
            'port' => env('SOLRDB_PORT', '8983'),
            'path' => env('SOLRDB_PATH', '/solr/'),
            'core' => env('SOLRDB_CORE', 'collection1')
        ]
    ]
];