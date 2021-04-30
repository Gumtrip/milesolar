<table>
    <thead>
    <tr>
        <th>{{$order->no}}</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    <tr class="thead">
        <td>Item</td>
        <td>Picture</td>
        <td>Description</td>
        <td>Unit Price</td>
        <td>Quantity</td>
        <td>Amount</td>
    </tr>
    @foreach($order->items as $item)
        <tr>
            <td>{{$item->title}}</td>
            <td class="img">
                @if(isset($blade))
                    <img src="{{$item->img}}">
                @endif
            </td>
            <td>{{$item->title}}</td>
            <td>{{$order->currency}} {{$item->price}}</td>
            <td>{{$item->amount}}</td>
            <td>{{$order->currency}} {{$item->amount * $item->price}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot></tfoot>
</table>
<style>
    .thead {
        background: #008000;
    }

    .img {
        width: 50px;
        height: 50px;
        text-align: center;
    }

    .img img {
        max-height: 100%;
        max-width: 100%
    }
</style>