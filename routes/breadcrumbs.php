<?php

use App\Models\Course;
use App\Models\AbInventech;
use App\Models\Company;
use App\Models\Site;
use App\Models\TrainingSlot;
use App\Models\Training;

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

// Home > Index
Breadcrumbs::for('to-home', function (BreadcrumbTrail $trail, $label, $routeName) {
    $trail->parent('home');
    $trail->push($label, route($routeName));
});


/**
 * crud pages
 */
// Home > Index > Show/Edit
Breadcrumbs::for('crud.show', function ($trail, $indexLabel, $indexRoute, $pageLabel, $modelRoute, $model) {
    // Home > Index
    $trail->parent('to-home', $indexLabel, $indexRoute);

    // Home > Index > PageLabel
    $trail->push($pageLabel, route($modelRoute, $model));
});

// Home > Index > Create
Breadcrumbs::for('crud.create', function ($trail, $indexLabel, $indexRoute, $pageLabel, $createRoute) {
    $trail->parent('to-home', $indexLabel, $indexRoute);
    $trail->push($pageLabel, route($createRoute));
});



/**
 * booking system
 */

// Home > Course
Breadcrumbs::for('bookings.course', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Course', route('trainings.bookings.course'));
});

// Home > Course > [Time]
Breadcrumbs::for('bookings.slot', function (BreadcrumbTrail $trail) {
    $trail->parent('bookings.course');
    $trail->push('Time', route('trainings.bookings.slot'));
});

// Home > Course > Time > Employees
Breadcrumbs::for('bookings.employees', function (BreadcrumbTrail $trail) {
    $trail->parent('bookings.slot');
    $trail->push('Participants', route('trainings.bookings.employees'));
});

// Home > Course > Time > [Confirm]
Breadcrumbs::for('bookings.summary', function (BreadcrumbTrail $trail) {
    $trail->parent('bookings.employees');
    $trail->push('Confirm', route('trainings.bookings.summary'));
});

