<?php
    /** @var \App\Models\Currency $currency */
?>
<form action="{{route('currencySave')}}" method="post">
    @csrf
    <input name="code" placeholder="code" @if(empty($fields["code"]) || !empty($errorsValidate['code']))
        value="{{$currency->code}}"
           @else value="{{$fields["code"]}}"
        @endif>
    @if (!empty($errorsValidate['code']))
        <span style="color: #FF2D20">
            {{$errorsValidate['code']}}
        </span>
    @endif
    <br>
    <input name="name" placeholder="name" @if(empty($fields["name"]) || !empty($errorsValidate['name']))
        value="{{$currency->name}}"
           @else value="{{$fields["name"]}}"
        @endif>
    @if (!empty($errorsValidate['name']))
        <span style="color: #FF2D20">
            {{$errorsValidate['name']}}
        </span>
    @endif
    <br>

    <input name="value" placeholder="value" @if(empty($fields["value"])|| !empty($errorsValidate['value']))
        value="{{$currency->value}}"
           @else value="{{$fields["value"]}}"
        @endif>
    @if (!empty($errorsValidate['value']))
        <span style="color: #FF2D20">
            {{$errorsValidate['value']}}
        </span>

    @endif
    <br>
    <input type="submit">
</form>
