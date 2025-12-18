<x-mail::message>
# Welcome to {{ config('app.name') }}

Dear {{ $first_name }} {{ $last_name }},

Your account has been created and you can now log in to the system.

For security reasons, please change your password after your first time logging in by visiting your profile page.

<x-mail::panel>
    Email: {{ $email }}
    Temporary password: {{ $password }}
</x-mail::panel>

<x-mail::button :url="$url" color="primary">
Log in to your account
</x-mail::button>

@if($role === 'leader')
To create an account for your employees, please go to the "Employees" tab in the sidebar.
@endif

    Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
