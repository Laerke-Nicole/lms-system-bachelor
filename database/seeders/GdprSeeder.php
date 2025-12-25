<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gdpr;

class GdprSeeder extends Seeder
{
    public function run()
    {
        Gdpr::updateOrCreate(
            ['content' => 'Last updated: 01. January 2026'],
            ['content' => 'Last updated: 01. January 2026']
        );

        Gdpr::updateOrCreate(
            ['content' => 'This Privacy Policy explains how we collect, use, store, and protect personal data when you use our Learning Management System ("LMS").
            The LMS is used by companies and their employees to manage training activities, bookings, and training records.'],
            ['content' => 'This Privacy Policy explains how we collect, use, store, and protect personal data when you use our Learning Management System ("LMS").
            The LMS is used by companies and their employees to manage training activities, bookings, and training records.']
        );

        Gdpr::updateOrCreate(
            ['title' => 'What data we collect'],
            [
                'title' => 'What data we collect',
                'content' => 'We process only the data necessary to provide the LMS services. This may include:',
            ]
        );

        Gdpr::updateOrCreate(
            ['content' => 'Account information: First name, last name, email, phone number, role (employee, leader or admin), company /site affiliation.'],
            ['content' => 'Account information: First name, last name, email, phone number, role (employee, leader or admin), company /site affiliation.']
        );

        Gdpr::updateOrCreate(
            ['content' => 'Training Data: Courses you are booked on, training history, training status (completed, expired, upcoming), certificates.'],
            ['content' => 'Training Data: Courses you are booked on, training history, training status (completed, expired, upcoming), certificates.']
        );

        Gdpr::updateOrCreate(
            ['content' => 'Technical Information: session cookies (strictly necessary for login), register timestamps.'],
            ['content' => 'Technical Information: session cookies (strictly necessary for login), register timestamps.']
        );

        Gdpr::updateOrCreate(
            ['content' => 'We do not collect or process sensitive personal data through the LMS.'],
            ['content' => 'We do not collect or process sensitive personal data through the LMS.']
        );

        Gdpr::updateOrCreate(
            ['title' => 'Purpose of Processing'],
            [
                'title' => 'Purpose of Processing',
                'content' => 'Your personal data is processed for the following purposes:',
            ]
        );

        Gdpr::updateOrCreate(
            ['content' => 'Creating and managing your LMS user account, allowing leaders to register employees for training, displaying your training history and certificates, providing training reminders and notifications, maintaining system security and preventing unauthorized access.'],
            ['content' => 'Creating and managing your LMS user account, allowing leaders to register employees for training, displaying your training history and certificates, providing training reminders and notifications, maintaining system security and preventing unauthorized access.']
        );

        Gdpr::updateOrCreate(
            ['title' => 'Data Sharing'],
            [
                'title' => 'Data Sharing',
                'content' => 'We may share your data only with:',
            ]
        );

        Gdpr::updateOrCreate(
            ['content' => "Your employer's LMS administrators and leaders, training providers responsible for delivering your courses, service providers who host or support the LMS (cloud, email, hosting)."],
            ['content' => "Your employer's LMS administrators and leaders, training providers responsible for delivering your courses, service providers who host or support the LMS (cloud, email, hosting)."]
        );

        Gdpr::updateOrCreate(
            ['content' => 'We do not sell or share data with third parties for marketing.'],
            ['content' => 'We do not sell or share data with third parties for marketing.']
        );

        Gdpr::updateOrCreate(
            ['title' => 'International Transfers'],
            [
                'title' => 'International Transfers',
                'content' => 'All personal data is stored in the EU/EEA, and no international transfers occur.',
            ]
        );

        Gdpr::updateOrCreate(
            ['title' => 'Data Retention'],
            [
                'title' => 'Data Retention',
                'content' => 'We retain your data only for as long as necessary:',
            ]
        );

        Gdpr::updateOrCreate(
            ['content' => 'Account data: deleted after the company removes your account, training data: stored for 2 years.'],
            ['content' => 'Account data: deleted after the company removes your account, training data: stored for 2 years.']
        );

        Gdpr::updateOrCreate(
            ['title' => 'Your Rights'],
            [
                'title' => 'Your Rights',
                'content' => 'Under GDPR, you have the right to:',
            ]
        );

        Gdpr::updateOrCreate(
            ['content' => 'Access your data, correct inaccurate data, request deletion of your account, restrict or object to processing, request data portability, file a complaint with a Data Protection Authority.'],
            ['content' => 'Access your data, correct inaccurate data, request deletion of your account, restrict or object to processing, request data portability, file a complaint with a Data Protection Authority.']
        );

        Gdpr::updateOrCreate(
            ['content' => 'Requests can be made via your company administrator.'],
            ['content' => 'Requests can be made via your company administrator.']
        );

        Gdpr::updateOrCreate(
            ['title' => 'Security'],
            [
                'title' => 'Security',
                'content' => 'We use appropriate technical and organizational security measures, including:',
            ]
        );

        Gdpr::updateOrCreate(
            ['content' => 'Encrypted passwords, HTTPS encryption, role-based access control, secure hosting and database protection.'],
            ['content' => 'Encrypted passwords, HTTPS encryption, role-based access control, secure hosting and database protection.']
        );

        Gdpr::updateOrCreate(
            ['title' => 'Cookies'],
            [
                'title' => 'Cookies',
                'content' => 'The LMS uses only essential cookies, such as:',
            ]
        );

        Gdpr::updateOrCreate(
            ['content' => 'Session cookie (to keep you logged in), security cookies (CSRF protection).'],
            ['content' => 'Session cookie (to keep you logged in), security cookies (CSRF protection).']
        );

        Gdpr::updateOrCreate(
            ['content' => 'These cookies do not require consent. No marketing, tracking, or analytics cookies are used by default.'],
            ['content' => 'These cookies do not require consent. No marketing, tracking, or analytics cookies are used by default.']
        );
    }
}
