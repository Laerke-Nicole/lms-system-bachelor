<?php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Course
Breadcrumbs::for('course', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Course', route('trainings.bookings.course'));
});

// Home > Course > [Time]
Breadcrumbs::for('slot', function (BreadcrumbTrail $trail) {
    $trail->parent('course');
    $trail->push('Time', route('trainings.bookings.slot'));
});

