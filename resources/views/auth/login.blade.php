@include ('layouts.navbar')
@section('content')
    <h2>Login Page</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <button type="submit">Login</button>
    </form>
@endsection
