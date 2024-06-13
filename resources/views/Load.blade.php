<div id="test">Загрузка</div>

<script>
    fetch("{{route("ListJS")}}",{
        method:"GET",
    }).then(response=>response.json())
        .then(response=>{
            document.getElementById('test').innerText = response?.listCurrency;
        });
</script>
