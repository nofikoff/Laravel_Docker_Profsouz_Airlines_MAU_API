<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'profile' => 'r,u'
        ],

        'administrator' => [

        ],

        'executive_committee' => [

        ],

        'maintence_service' => [

        ],

        'computer_committee' => [

        ],

        'union_senior' => [

        ],

        'chief' => [

        ],

        'member_hotel' => [

        ],

        'member_overalls' => [

        ],

        'member_food' => [

        ],

        'member_delivery' => [

        ],
    ],
    'permission_structure' => [
        'cru_user' => [
            'profile' => 'c,r,u'
        ],
    ],
    'permissions_map' => [
        'c'     => 'create',
        'r'     => 'read',
        'u'     => 'update',
        'd'     => 'delete',
        'cpre'  => 'create-premoderation',
        'co'    => 'comment',
        'no'    => 'notify',
    ]
];
