@extends('layouts.app')

@section('content')

    @include('components.message')

    <div class="container">
        <div class="row">
            <div class="d-flex py-2 w-50">
                <p class="h2 mt-0">Koszyk</p>
            </div>
        </div>
        <div class="row">
            <div class="grid pb-3 justify-content-center align-items-center" style="--bs-columns: 1;">
                @forelse($items as $key => $item)
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-1 d-flex justify-content-center align-items-center">{{$key + 1}}.</div>
                            <div class="col-md-4 d-flex align-items-center justify-content-center p-2">
                                <img src="{{url($item->thumbnail)}}" class="img-fluid rounded-start" alt="" style="height: 150px">
                            </div>
                            <div class="col-md-5 d-flex justify-content-center align-items-center">
                                <div class="card-body">
                                    <h5 class="card-title">{{$item->title}}</h5>
                                    <p class="card-text">{{$item->description}}</p>
                                    <p class="card-text"><span class="fw-bold">Kategorie: </span>{{$item->categories->pluck('name')->join(', ')}}</p>
                                    <p class="h5">Cena: {{$item->price}} zł</p>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center align-items-center">
                                <div class="row w-100 px-4">
                                    <div class="col text-end p-0 m-0">
                                        <a href="{{ route('cart.delete', $item) }}" class="btn btn-sm btn-outline-danger">Usuń</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="row justify-content-center">
                        <div class="alert alert-warning col-md-8">
                            <p class="py-2 m-0">Brak produktów w koszyku</p>
                        </div>
                    </div>
                @endforelse
            @if($total > 0)
                <div class="row py-4 px-3">
                    <hr>
                    <div class="col-md-12 text-end">
                        <p class="h4 mt-2 py-4 mr-2">Suma: {{number_format($total, 2)}} zł</p>
                        <a class="btn btn-outline-primary px-4 py-2" href="{{route('payment.checkout')}}">Zamów</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
