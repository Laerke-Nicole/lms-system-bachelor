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

// Home > []
Breadcrumbs::for('to-home', function (BreadcrumbTrail $trail, $label, $routeName) {
    $trail->parent('home');
    $trail->push($label, route($routeName));
});


/**
 * crud pages
 */
Breadcrumbs::for('courses.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Courses', route('courses.index'));
});

// Home > Course > []
Breadcrumbs::for('course', function (BreadcrumbTrail $trail, Course $course, $label) {
    $trail->parent('courses.index');
    $trail->push($label, route('courses.index', $course));
});

// Home > Course > Create
Breadcrumbs::for('courses.create', function (BreadcrumbTrail $trail) {
    $trail->parent('courses.index');
    $trail->push('Create course', route('courses.create'));
});


// Home > AB Inventech > []
Breadcrumbs::for('ab_inventech', function (BreadcrumbTrail $trail, AbInventech $abInventech, $label) {
    $trail->parent('ab_inventech.index');
    $trail->push($label, route('ab_inventech.index', $abInventech));
});


Breadcrumbs::for('companies.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Companies', route('companies.index'));
});


// Home > Companies > []
Breadcrumbs::for('company', function (BreadcrumbTrail $trail, Company $company, $label) {
    $trail->parent('companies.index');
    $trail->push($label, route('companies.index', $company));
});

// Home > Course > Create
Breadcrumbs::for('companies.create', function (BreadcrumbTrail $trail) {
    $trail->parent('companies.index');
    $trail->push('Create', route('companies.create'));
});


// Home > Sites
Breadcrumbs::for('sites.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Sites', route('sites.index'));
});

// Home > Sites > []
Breadcrumbs::for('site', function (BreadcrumbTrail $trail, Site $site, $label) {
    $trail->parent('sites.index');
    $trail->push($label, route('sites.index', $site));
});

// Home > Sites > Create
Breadcrumbs::for('sites.create', function (BreadcrumbTrail $trail) {
    $trail->parent('sites.index');
    $trail->push('Create', route('sites.create'));
});


// Home > Training Slots
Breadcrumbs::for('training_slots.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Training Slots', route('training_slots.index'));
});

// Home > Training Slots > []
Breadcrumbs::for('training_slot', function (BreadcrumbTrail $trail, TrainingSlot $trainingSlot, $label) {
    $trail->parent('training_slots.index');
    $trail->push($label, route('training_slots.index', $trainingSlot));
});

// Home > Training Slots > Create
Breadcrumbs::for('training_slots.create', function (BreadcrumbTrail $trail) {
    $trail->parent('training_slots.index');
    $trail->push('Create', route('training_slots.create'));
});


// Home > Trainings
Breadcrumbs::for('trainings.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Trainings', route('trainings.index'));
});

// Home > Trainings > []
Breadcrumbs::for('training', function (BreadcrumbTrail $trail, Training $training, $label) {
    $trail->parent('trainings.index');
    $trail->push($label, route('trainings.index', $training));
});

// Home > Trainings > Create
Breadcrumbs::for('trainings.create', function (BreadcrumbTrail $trail) {
    $trail->parent('trainings.index');
    $trail->push('Create', route('trainings.create'));
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

