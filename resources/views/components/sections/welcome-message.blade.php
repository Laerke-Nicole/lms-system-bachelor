<h2>Hi, {{ auth()->user()->first_name }}</h2>
<p>
    @if(auth()->user()->role === 'user')
        Welcome, here’s an overview of your training.
    @elseif(auth()->user()->role === 'leader')
        Welcome, here’s an overview of your employees training.
    @else
        Here’s an overview of the platform activity.
    @endif
</p>
