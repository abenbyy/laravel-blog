@extends('layout.master')

@section('title', 'Product Index')

@section('nav')
<ul>
    <li>
        <a href="#">Nav1</a>
    </li>
    <li>
        <a href="#">Nav2</a>
    </li>
    <li>
        <a href="#">Nav3</a>
    </li>
    <li>
        <a href="#">Nav4</a>
    </li>
</ul>
    
@endsection

@section('content')
    <div>
        <form action="" method="get">
            {{-- <input type="hidden" name="page" value="{{ $products->currentPage() }}"> --}}
            <input type="text" name="query" id="">
            <button>Search</button>
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>Product Id</th>
                <th>Product Name</th>
                <th>Product Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
            <tr>
                <th>{{$item->id}}</th>
                <th>{{$item->name}}</th>
                <th>{{$item->price}}</th>
                <th>
                    <form action="{{ url("product/delete/{$item->id}") }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id">
                        <input type="submit" value="Delete">
                    </form>
                </th>
            </tr>    
            @endforeach
        </tbody>
    </table>
    {{ $products->appends($_GET)->links() }}
    {{-- <form action="{{ url('products/create') }}" method="post"> --}}
    <form action="{{ route('post_product') }}" method="post" id="form-insert">
        {{-- 3 ways to add CSRF Token--}}
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id:=>
        {{ csrf_field() }}
        @csrf

        <label for="">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name')}}">
        <br>
        <label for="">Price</label>
        <input type="text" name="price" id="price" value="{{ old('price')}}">
        <input type="submit" value="Insert" id="btn-insert">
    </form>
    <br>
    @if ($errors->any())
        @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    @endif

    {{-- @if (session()->has('message'))
        {{ session()->get('message') }}
    @endif --}}

    @if (Session::has('message'))
        {{ Session::get('message') }}
    @endif

    <script>
        $.ajax({
                url: "{{ url('product/1') }}",
            }).done(function(response){
                console.log(response)
            })


        $('#form-insert').submit(function(e){
            e.preventDefault();
            
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                //url: "{{ route('post_product') }}",
                //method: "POST",
                data:{
                    _token: $(this).find("input[name='_token']").val(), //if no ajaxSetup
                    name: $(this).find("input[name='name']").val(),
                    price: $(this).find("input[name='price']").val(),
                }
            }).done(function(response){
                window.location.reload();
            })
        })
    </script>
@endsection