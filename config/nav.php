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
        'active' => 'categories.*'
    ],
    [
        'icon' => 'nav-icon fas fa-tag',
        'route' => 'products.index',
        'title' => 'Products',
        'active' => 'products.*'
    ],
    [
        'icon' => 'nav-icon fas fa-file-alt',
        'route' => 'orders.index',
        'title' => 'Orders',
        'active' => 'orders.*'
    ],
    [
        'icon' => 'nav-icon fas fa-users',
        'route' => 'categories.index',
        'title' => 'Users',
        'active' => 'users.*'
    ]

];
