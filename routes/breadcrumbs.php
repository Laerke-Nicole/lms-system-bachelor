<?php

use App\Models\Course;

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


/**
 * crud pages
 */
Breadcrumbs::for('courses.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Courses', route('courses.index'));
});

// Home > Course
Breadcrumbs::for('course', function (BreadcrumbTrail $trail, Course $course, $label) {
    $trail->parent('courses.index');
    $trail->push($label, route('courses.index', $course));
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

