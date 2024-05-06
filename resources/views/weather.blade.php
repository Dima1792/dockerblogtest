<?php
/** @var \App\Models\Currency $currency */
?>
@extends('basa')
@section('contents1')
    <h2>Давайте узнаем погода в некоторых городах?</h2>
    @foreach($result as $key=>$value)
        <div> {{$value}}</div>
    @endforeach
    <form action='/weather' method='get'>
        <select type="text" name="cityGet" method="post">
            @foreach ($listCity as $key)
                <option value={{$key}}>{{$key}}</option>;
            @endforeach
        </select>
        <select type="text" name="params" value="param">
            @foreach ($listParams as $value)
                <option value={{$value}}>{{$value}}</option>;
            @endforeach
        </select>
        <input type="number" min="0" max="168" value="0" name="timeGet">
        <input type="submit" name="save" VALUE="Узнать погоду" >
    </form>
    <p> </p>
@endsection

