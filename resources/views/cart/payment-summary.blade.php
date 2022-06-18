@extends('layouts.app')

@section('content')
    @include('components.message')
    <div class="container">
        <div class="row justify-content-center p-4">
            <table class="table w-50">
                <thead>
                <tr>
                    <th scope="col">ID zamówienia</th>
                    <th scope="col">Status</th>
                    <th scope="col">Cena</th>
                    <th scope="col">Zamówiono</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td style="width: 300px">{{$order->order_id}}</td>
                        <td>{{$order->status->getName()}}</td>
                        <td>{{$order->total}} zł</td>
                        <td>{{$order->created_at->toDateTimeString()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
