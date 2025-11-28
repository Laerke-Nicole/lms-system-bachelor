<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gdpr;

class GdprSeeder extends Seeder
{
    public function run()
    {
        Gdpr::create([
            'content' => 'Last updated: 01. January 2026',
        ]);

        Gdpr::create([
            'content' => 'This Privacy Policy explains how we collect, use, store, and protect personal data when you use our Learning Management System (“LMS”).
            The LMS is used by companies and their employees to manage training activities, bookings, and training records.',
        ]);

        Gdpr::create([
            'title' => 'What data we collect',
            'content' => 'We process only the data necessary to provide the LMS services. This may include:',
        ]);

        Gdpr::create([
            'content' => 'Account information: First name, last name, email, phone number, role (employee, leader or admin), company /site affiliation.',
        ]);

        Gdpr::create([
            'content' => 'Training Data: Courses you are booked on, attendance information, training history, training status (completed, missed, upcoming), certificates, your test results.',
        ]);

        Gdpr::create([
            'content' => 'Technical Information: session cookies (strictly necessary for login), register timestamps.',
        ]);

        Gdpr::create([
            'content' => 'We do not collect sensitive data unless required by the training provider (e.g. medical requirements for certain safety courses). When necessary, such data is processed under strict GDPR rules.',
        ]);

        Gdpr::create([
            'title' => 'Purpose of Processing',
            'content' => 'Your personal data is processed for the following purposes:',
        ]);

        Gdpr::create([
            'content' => 'Creating and managing your LMS user account, allowing leaders to register employees for training, displaying your training history and certificates, providing training reminders and notifications, maintaining system security and preventing unauthorized access.',
        ]);

        Gdpr::create([
            'title' => 'Data Sharing',
            'content' => 'We may share your data only with:',
        ]);

        Gdpr::create([
            'content' => 'Your employer’s LMS administrators and leaders, training providers responsible for delivering your courses, service providers who host or support the LMS (cloud, email, hosting).',
        ]);

        Gdpr::create([
            'content' => 'We do not sell or share data with third parties for marketing.',
        ]);

        Gdpr::create([
            'title' => 'Data Retention',
            'content' => 'We retain your data only for as long as necessary:',
        ]);

        Gdpr::create([
            'content' => 'Account data: deleted after the company removes your account, training data: stored according to company/legal requirements (often 3–5 years).',
        ]);

        Gdpr::create([
            'title' => 'Your Rights',
            'content' => 'Under GDPR, you have the right to:',
        ]);

        Gdpr::create([
            'content' => 'Access your data, correct inaccurate data, request deletion of your account, restrict or object to processing, request data portability, file a complaint with a Data Protection Authority.',
        ]);

        Gdpr::create([
            'content' => 'Requests can be made via your company administrator.',
        ]);

        Gdpr::create([
            'title' => 'Security',
            'content' => 'We use appropriate technical and organizational security measures, including:',
        ]);

        Gdpr::create([
            'content' => 'Encrypted passwords, HTTPS encryption, role-based access control, secure hosting and database protection.',
        ]);

        Gdpr::create([
            'title' => 'Cookies',
            'content' => 'The LMS uses only essential cookies, such as:',
        ]);

        Gdpr::create([
            'content' => 'Session cookie (to keep you logged in), security cookies (CSRF protection).',
        ]);

        Gdpr::create([
            'content' => 'These cookies do not require consent. No marketing, tracking, or analytics cookies are used by default.',
        ]);
    }
}
