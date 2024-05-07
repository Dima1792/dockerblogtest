<form action="{{route('currencySave')}}" method="post">
    @csrf
    <input name="code" placeholder="code">
    @if (!empty($errorsValidate['code']))
        <span style="color: #FF2D20">
            {{$errorsValidate['code']}}
        </span>
    @endif
    <br>
    <input name="name" placeholder="name">
    @if (!empty($errorsValidate['name']))
        <span style="color: #FF2D20">
            {{$errorsValidate['name']}}
        </span>
    @endif
    <br>
    <input name="value" placeholder="value">
    @if (!empty($errorsValidate['value']))
        <span style="color: #FF2D20">
            {{$errorsValidate['value']}}
        </span>
    @endif
    <br>
    <input type="submit">
</form>

