@foreach($currencies as $currency)
{{$currency->code}}{{$currency->value}}
    <a href="{{route('currencyGet',['code'=>$currency->code])}}">Подробнее...</a>
    <a href="{{route('currencyEdit',['currency'=>$currency->id])}}">Изменить...</a><br>
@endforeach
<a href="{{route(('currencySaveForm'))}}">Create</a>
