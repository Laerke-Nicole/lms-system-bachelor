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

// Home > [Index]
Breadcrumbs::for('to-home', function (BreadcrumbTrail $trail, $label, $routeName) {
    $trail->parent('home');
    $trail->push($label, route($routeName));
});


/**
 * crud pages
 */
// Home > Index > [Show/Edit]
Breadcrumbs::for('crud.show', function ($trail, $indexLabel, $indexRoute, $pageLabel, $modelRoute, $model) {
    // Home > Index
    $trail->parent('to-home', $indexLabel, $indexRoute);

    // Home > Index > PageLabel
    $trail->push($pageLabel, route($modelRoute, $model));
});

// Home > Index > [Create]
Breadcrumbs::for('crud.create', function ($trail, $indexLabel, $indexRoute, $pageLabel, $createRoute) {
    $trail->parent('to-home', $indexLabel, $indexRoute);
    $trail->push($pageLabel, route($createRoute));
});


// Home > Courses > [Course materials]
Breadcrumbs::for('courses.course_materials', function (BreadcrumbTrail $trail, $course) {
    $trail->parent('to-home', 'Courses', 'courses.index');
    $trail->push('Course materials', route('courses.course_materials.index', $course));
});

// Home > Courses > Course materials > [Create]
Breadcrumbs::for('courses.course_materials.create', function (BreadcrumbTrail $trail, $course) {
    $trail->parent('to-home', 'Courses', 'courses.index');
    $trail->push('Course materials', route('courses.course_materials.index', $course));
    $trail->push('Create', route('courses.course_materials.index', $course));
});

// Home > Courses > Course materials > [Edit]
Breadcrumbs::for('courses.course_materials.edit', function (BreadcrumbTrail $trail, $course) {
    $trail->parent('to-home', 'Courses', 'courses.index');
    $trail->push('Course materials', route('courses.course_materials.index', $course));
    $trail->push('Edit', route('courses.course_materials.index', $course));
});

// Home > Courses > [Requirements]
Breadcrumbs::for('courses.requirements', function (BreadcrumbTrail $trail, $course) {
    $trail->parent('to-home', 'Courses', 'courses.index');
    $trail->push('Requirements', route('courses.requirements.index', $course));
});

// Home > Courses > Requirements > [Create]
Breadcrumbs::for('courses.requirements.create', function (BreadcrumbTrail $trail, $course) {
    $trail->parent('to-home', 'Courses', 'courses.index');
    $trail->push('Requirements', route('courses.requirements.index', $course));
    $trail->push('Create', route('courses.requirements.index', $course));
});

// Home > Courses > Course materials > [Edit]
Breadcrumbs::for('courses.requirements.edit', function (BreadcrumbTrail $trail, $course) {
    $trail->parent('to-home', 'Courses', 'courses.index');
    $trail->push('Requirements', route('courses.requirements.index', $course));
    $trail->push('Edit', route('courses.requirements.index', $course));
});

// Home > Courses > Course materials > [View]
Breadcrumbs::for('courses.requirements.show', function (BreadcrumbTrail $trail, $course) {
    $trail->parent('to-home', 'Courses', 'courses.index');
    $trail->push('Requirements', route('courses.requirements.index', $course));
    $trail->push('View', route('courses.requirements.index', $course));
});

// Home > Trainings > [Course materials]
Breadcrumbs::for('sections.course-materials', function (BreadcrumbTrail $trail, $training) {
    $trail->parent('to-home', 'Trainings', 'trainings.index');
    $trail->push('Course materials', route('sections.course-materials', $training));
});




/**
 * signature
 */

// Home > Trainings > [Choose]
Breadcrumbs::for('signatures.choose', function (BreadcrumbTrail $trail, $trainingUser) {
    $trail->parent('to-home', 'Trainings', 'trainings.index');
    $trail->push('Choose', route('signatures.choose', $trainingUser));
});

// Home > Trainings > Choose > [Upload signature]
Breadcrumbs::for('signatures.digital.digital', function (BreadcrumbTrail $trail, $trainingUser) {
    $trail->parent('signatures.choose', $trainingUser);
    $trail->push('Upload signature', route('signatures.digital.digital', $trainingUser));
});

// Home > Trainings > Choose > Upload signature > [Confirm]
Breadcrumbs::for('signatures.digital.digital-confirm', function (BreadcrumbTrail $trail, $trainingUser) {
    $trail->parent('signatures.digital.digital', $trainingUser);
    $trail->push('Confirm', route('signatures.digital.digital-confirm', $trainingUser));
});

// Home > Trainings > Choose > [Printed signature]
Breadcrumbs::for('signatures.printed.printed', function (BreadcrumbTrail $trail, $trainingUser) {
    $trail->parent('signatures.choose', $trainingUser);
    $trail->push('Printed signature', route('signatures.printed.printed', $trainingUser));
});


/**
 * booking system
 */

// Home > [Course]
Breadcrumbs::for('bookings.course', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Course', route('trainings.bookings.course'));
});

// Home > Course > [Time]
Breadcrumbs::for('bookings.slot', function (BreadcrumbTrail $trail) {
    $trail->parent('bookings.course');
    $trail->push('Time', route('trainings.bookings.slot'));
});

// Home > Course > Time > [Employees]
Breadcrumbs::for('bookings.employees', function (BreadcrumbTrail $trail) {
    $trail->parent('bookings.slot');
    $trail->push('Participants', route('trainings.bookings.employees'));
});

// Home > Course > Time > [Confirm]
Breadcrumbs::for('bookings.confirm', function (BreadcrumbTrail $trail) {
    $trail->parent('bookings.employees');
    $trail->push('Confirm', route('trainings.bookings.confirm'));
});

// Home > Course > Time > Confirm > [Done]
Breadcrumbs::for('bookings.summary', function (BreadcrumbTrail $trail) {
    $trail->parent('bookings.confirm');
    $trail->push('Done', route('trainings.bookings.summary'));
});

