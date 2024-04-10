<?php
    /** @var \App\Models\Currency $currency */
?>
<form action="{{route('currencySave')}}" method="post">
    @csrf
    <input name="code" placeholder="code" value="{{$currency->code}}">
    <input name="name" placeholder="name" value="{{$currency->name}}">
    <input name="value" placeholder="value" value="{{$currency->value}}">
    <input type="submit">
</form>
