<?php
    return [
        'weights' => [
            'default' => 5,
            'recent'  => 1,
        ],
        'history' => [
            'max_recent' => 3,
        ],
        'developer_mode' => env('APP_DEV_MODE', false),
    ];
