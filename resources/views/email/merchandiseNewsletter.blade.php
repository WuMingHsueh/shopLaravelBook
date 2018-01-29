<h1>Hi {{ $User->nickname }}，以下是最新的商品</h1>

<table border="1">
    <tr>
        <th>名稱</th>
        <th>價格</th>
    </tr>
    @foreach ($MerchandiseCollection as $merchandise)
    <tr>
        <td>
            <a href="{{ url('/merchandise/' . $merchandise->id) }}">
                {{ $merchandise->name }}
            </a>
        </td>
        <td>
            {{ $merchandise->price }}
        </td>
    </tr>
    @endforeach
</table>