<?php
/** @var \App\Models\Currency $currency */
?>
@extends('basa')
@section('contents1')
    <div id="waitCity">Выберете город из списка</div>

    <script>
        fetch("{{route("ListJS")}}",{
            method:"GET",
        }).then(response=>response.json())
            .then(response=>{
                document.getElementById('ListJS').innerText = response?.listCurrency;
            });
        <h2>Давайте узнаем погода в некоторых городах?</h2>
        @foreach($result as $key=>$value)
        <div> {{$value}}</div>
        @endforeach
    </script>

    <form action='/weather' method='get'>
        <select type="text" name="cityGet"
            @foreach ($listCity as $key)
                <option @if($key === $city) selected @endif value={{$key}}>{{$key}}</option>;
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

