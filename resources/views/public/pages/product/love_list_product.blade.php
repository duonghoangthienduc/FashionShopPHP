@extends('index')
@section('content')
    <x-breadCrumb></x-breadCrumb>

    <div class="container-fluid">
        <div class="px-xl-5">
            <div class="table-responsive mb-5">
                @if ($love_list != null)
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">

                            @forelse ($love_list as $cart)
                                <tr>
                                    <td class="align-middle">
                                        <a href="{{ route('Product Detail', $cart['id']) }}" style="color: black">
                                            {{ $cart['name'] }} </a>
                                    </td>
                                    <td class="align-middle"><img src="{{ $cart['image'] }}" alt=""
                                            style="width: 50px;"></td>
                                    <td class="align-middle">
                                        {{ number_format($cart['price']) }} VND
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('Remove Like', $cart['id']) }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse


                        </tbody>
                    </table>
                @else
                    @include('public.pages.BlankPage.blank_page')
                @endif
            </div>
        </div>
    </div>
@endsection
