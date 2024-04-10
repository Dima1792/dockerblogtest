<form action="{{route('currencySave')}}" method="post">
    @csrf
    <input name="code" placeholder="code">
    <input name="name" placeholder="name">
    <input name="value" placeholder="value">
    <input type="submit">
</form>
