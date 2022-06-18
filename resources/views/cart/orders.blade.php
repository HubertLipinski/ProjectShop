@extends('layouts.app')

@section('content')
    @include('components.message')
    <div class="container">
        <div class="row">
            <div class="d-flex py-2 w-50">
                <p class="h2 mt-0">Moje zamówienia</p>
            </div>
        </div>
        @if($orders->count())
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
        @else
            <div class="row justify-content-center">
                <div class="alert alert-warning col-md-8">
                    <p class="py-2 m-0">Brak zamówień</p>
                </div>
            </div>
        @endif
    </div>
@endsection
