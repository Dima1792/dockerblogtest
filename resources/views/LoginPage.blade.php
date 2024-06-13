@extends('basa')
@section('contents1')
    <h2>Inter your name</h2>
    <form action='/hello' method='post'>
        @csrf
        <p> <input type="text" name="nameUser" VALUE="Дима"></p>
        <input type="submit" name="save" VALUE="Go">
    </form>
@endsection
