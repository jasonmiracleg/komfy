@extends('layouts.app')

@section('content')
    <div class="container pt-5">

        <div class="mx-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Varian</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $counter = 0;
                    @endphp
                    @foreach ($orders as $order)
                        @if ($order->bill_id == null)
                            @if ($order->user_id == $user_id)
                                @php
                                    $counter += 1;
                                @endphp
                                <tr>
                                    <th scope="row"> {{ $counter }} </th>
                                    @foreach ($variants as $variant)
                                        @if ($variant->id == $order->variant_id)
                                            @foreach ($products as $product)
                                                @if ($product->id == $variant->product_id)
                                                    <td> {{ $product->product_name }} </td>
                                                @endif
                                            @endforeach
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
                                            <button type="button" class="btn btn-danger"> Hapus </button>
                                        </a>
                                    </td>

                                </tr>
                            @endif
                        @endif
                    @endforeach

                </tbody>
            </table>

            <form method="POST" action="{{ route('member.checkout') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <button type="submit" class="btn btn-success"> Checkout </button>
            </form>
        </div>

        @include('layouts.footer')
    </div>
@endsection
