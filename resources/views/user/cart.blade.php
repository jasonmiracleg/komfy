@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Product</th>
                <th scope="col">Variant</th>
                <th scope="col">Quantity</th>
                <th scope="col">Order Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($orders as $order)
                <tr>

                    <th scope="row"> {{ $order->id }} </th>
                    @foreach ($products as $product)
                        @if ($product->id == $order->product_id)
                            <td> {{ $product->product_name }} </td>
                        @endif
                    @endforeach

                    @foreach ($variants as $variant)
                        @if ($variant->id == $order->variant_id)
                            <td> {{ $variant->variant_name }} </td>
                        @endif
                    @endforeach

                    <td> {{ $order->quantity }} </td>
                    <td> {{ $order->order_price }} </td>

                    <td>
                        <a href="/delete_order/{{ $order->id }}">
                            <button type="button" class="btn btn-danger"> Delete </button>
                        </a>
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>

    <form method="POST" action="/checkout">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <button type="submit" class="btn btn-success"> Checkout </button>
    </form>
@endsection