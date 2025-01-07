<x-layout>
    <h1 class="centered">Login Page</h1>
    @if($errors->has('login'))
        <div class="error-message centered">
            {{ $errors->first('login') }}
        </div>
    @endif
<div class="centered form-container">
    <form action="{{ route('login.authenticate') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="button-class" type="text" name="loginname" value="{{old('loginname')}}" placeholder="name">
        <input class="button-class" type="password" name="loginpassword" placeholder="password">
        <button class="button-class">Login</button>
    </form>
</div>

</x-layout>

