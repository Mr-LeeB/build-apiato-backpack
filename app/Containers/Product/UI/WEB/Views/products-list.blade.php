<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>List Products</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    @yield('css')

    <!-- Scripts -->
    @yield('js')

    {{-- php function --}}
    @php
        $productID = [];
        foreach ($products as $key => $value) {
            array_push($productID, $value->id);
        }
        $productID_json = json_encode($productID);
    @endphp

</head>

<body>
    @include('product::menu')

    <div class="parent">

        <!--List all products-->
        <div class="content">

            <div class="title m-b-md">
                <h1>Products</h1>
            </div>
            <div
                style="
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 100%;">
                <div class="create-new-product">
                    <form action="{{ route('web_get_product_create_page') }}" method="GET">
                        <input type="submit" class="btn-create" value="Create new product">
                    </form>
                </div>
                <div class="search-area">
                    <input class="input-search" type="text" name="search" placeholder="Search product"
                        oninput="searchByNameProduct()">
                </div>
            </div>


            @if (session('message'))
                <span> {{ session('message') }}</span>
            @endif


            <div class="links">
                <div class="delete-more-product">
                    <form action="{{ route('web_product_bulk_delete') }}" method="POST" id="form-delete-more-product">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        @foreach ($productID as $id)
                            <input type="hidden" name="id[]" id="selectedManyProductToDel{{ $id }}"
                                value="{{ $id }}">
                        @endforeach
                        <input type="button" onclick="confirmDeleteMoreProduct({{ $productID_json }})"
                            class="btn-delete" value="Delete Products">
                    </form>
                </div>
                <div class="paginationWrap">
                    @if (isset($product_description) && count($product_description) > 0)
                        {{ $products->links() }}
                    @endif
                </div>
                <table>
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll" onclick="checkAll({{ $productID_json }})" /></th>
                            {{-- <th>STT</th> --}}
                            <th>
                                <div class="sort">Id
                                    <div class="group-sort-icon">
                                        <i class="fa fa-sort-asc icon-sort-item" aria-hidden="true"
                                            onclick="sortFunc(1, {{ $num }})"></i>
                                        <i class="fa fa-sort-desc icon-sort-item" aria-hidden="true"
                                            onclick="sortFunc(2, {{ $num }})"></i>
                                    </div>
                                </div>
                            </th>
                            <th>
                                <div class="sort">
                                    Name
                                    <div class="group-sort-icon">
                                        <i class="fa fa-sort-asc icon-sort-item" aria-hidden="true"
                                            onclick="sortFunc(3, {{ $num }})"></i>
                                        <i class="fa fa-sort-desc icon-sort-item" aria-hidden="true"
                                            onclick="sortFunc(4, {{ $num }})"></i>
                                    </div>
                                </div>
                            </th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>
                                <div class="sort">Created
                                    <div class="group-sort-icon">
                                        <i class="fa fa-sort-asc icon-sort-item" aria-hidden="true"
                                            onclick="sortFunc(5, {{ $num }})"></i>
                                        <i class="fa fa-sort-desc icon-sort-item" aria-hidden="true"
                                            onclick="sortFunc(6, {{ $num }})"></i>
                                    </div>
                                </div>
                            </th>
                            <th colspan="2">Operation</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (isset($product_description) && count($product_description) > 0)
                            @foreach ($product_description as $product)
                                <tr id="{{ $product->id }}">
                                    <td>
                                        <input type="checkbox" id="select_product{{ $product->id }}"
                                            onclick="checkOne({{ $productID_json }})">
                                    </td>
                                    {{-- <td>{{ $loop->index + 1 }}</td> --}}
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td><img src="{{ asset($product->image) }}" alt="" width=""></td>
                                    <td>{{ substr($product->created_at, 0, 10) }}</td>
                                    <td class="operation">
                                        <form action="{{ route('web_product_find_by_id', $product->id) }}"
                                            method="GET">
                                            <input type="submit" class="btn-edit" value="More Detail">
                                        </form>
                                    </td>
                                    <td class="operation">
                                        <form class="form-detele-product" id="form-detele-product{{ $product->id }}"
                                            action="{{ route('web_product_delete', $product->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <input type="button" onclick="confirmDeleteProduct({{ $product->id }})"
                                                class="btn-delete" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="paginationWrap">
                    @if (isset($product_description) && count($product_description) > 0)
                        {{ $products->links() }}
                    @endif
                </div>
                <form id="form-sort" action="{{ route('web_product_get_all_products') }}" method="GET">
                    <input type="hidden" name="sort" id="sort">
                </form>
            </div>
        </div>
    </div>

</body>

</html>
