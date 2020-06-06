<form action="{{ url('auth/login') }}" method="post">
    @csrf
    <label for="">NIM/Email</label>
    <input type="text" name="account" id="">
    <br>
    <label for="">Password</label>
    <input type="password" name="password" id="password">
    <button>Login</button>
</form>