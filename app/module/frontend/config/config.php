<?php
/**
 * This file is part of phalcon-skeleton
 *
 * @copyright Copyright (C) 2020 Jayson Wang
 * @license   MIT License
 * @link      https://github.com/lsalio/phalcon-skeleton
 */
return [
    'module' => [
        'dispatcher' => [
            'controllerNamespace' => 'App\Frontend\Controller'
        ],
        'view' => [
            'uses' => true, // html by default
            'viewDir' => module_path('frontend/view'),
        ],
    ],
];