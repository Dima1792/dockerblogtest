<?php
    /** @var \App\Models\Currency $currency */
?>
<form action="{{route('currencySave')}}" method="post">
    @csrf
    <input name="code" placeholder="code" value="{{$currency->code}}">
    @if (!empty($errorsValidate['code']))
        <span style="color: #FF2D20">
            {{$errorsValidate['code']}}
        </span>
    @endif
    <br>
    <input name="name" placeholder="name" value="{{$currency->name}}">
    @if (!empty($errorsValidate['name']))
        <span style="color: #FF2D20">
            {{$errorsValidate['name']}}
        </span>
    @endif
    <br>

    <input name="value" placeholder="value" value="{{$currency->value}}">
    @if (!empty($errorsValidate['value']))
        <span style="color: #FF2D20">
            {{$errorsValidate['value']}}
        </span>

    @endif
    <br>
    <input type="submit">
</form>
