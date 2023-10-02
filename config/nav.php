<?php

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'index',
        'title' => 'Dashboard',
        'active' => 'index'
    ],
    [
        'icon' => 'nav-icon fas fa-file-alt',
        'route' => 'categories.index',
        'title' => 'Categories',
        'active' => 'categories.*',
        'permission' => 'categories.view',
    ],
    [
        'icon' => 'nav-icon fas fa-tag',
        'route' => 'products.index',
        'title' => 'Products',
        'active' => 'products.*',
        'permission' => 'products.view',
    ],
    [
        'icon' => 'nav-icon fas fa-file-alt',
        'route' => 'orders.index',
        'title' => 'Orders',
        'active' => 'orders.*',
        'permission' => 'orders.view',
    ],
    [
        'icon' => 'nav-icon fas fa-users',
        'route' => 'users.index',
        'title' => 'Users',
        'active' => 'users.*',
        'permission' => 'users.view',
    ],
    [
        'icon' => 'nav-icon fas fa-shield',
        'route' => 'roles.index',
        'title' => 'Roles',
        'active' => 'roles.*',
        'permission' => 'roles.view',
    ],
    [
        'icon' => 'nav-icon fas fa-users',
        'route' => 'amins.index',
        'title' => 'Admins',
        'active' => 'admins.*',
        'permission' => 'admins.view',
    ],

];
