@extends('basa')
@section('setting')
    <div class="dropdown">
        <button class="dropbtn">Dropdown</button>
        <div class="dropdown-content">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </div>
        <button class="dropbtn">Dropdown</button>
        <div class="dropdown-content">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </div>
        <button class="dropbtn">Dropdown</button>
        <div class="dropdown-content">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </div>
    </div>
@endsection
@section('contents1')
    <h2>Давайте узнаем погода в некоторых городах?</h2>
    @foreach($result as $key=>$value)
        <div> {{$value}}</div>
    @endforeach
    <form action='/weather' method='get'>
        <select type="text" name="cityGet">
            @foreach (json_decode(file_get_contents(dirname(__DIR__,3) . '/app/File/ListCity.txt')) as $key=>$value)
                <option value={{$key}}>{{$key}}</option>;
            @endforeach
        </select>
        <input type="number" min="0" max="168" value="0" name="timeGet">
        <input type="submit" name="save" VALUE="Узнать погоду" >
    </form>
    <p> </p>
@endsection

