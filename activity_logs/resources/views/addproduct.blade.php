<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Product Section') }}
        </h2>

    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-alert />
                    <div class="container">
                        <div class="row">
                            <form class="row g-3" method="post" action="{{ route('store') }}">
                                @csrf
                                <div class="col-md-12">
                                    <label for="inputEmail4" class="form-label">Product Name</label>
                                    <input type="text" name="product_name" :value="old('product_name')"
                                        class="form-control" id="inputEmail4">
                                    <span class="text-danger">
                                        @error('product_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-12">
                                    <label for="inputPassword4" class="form-label">Product Cost</label>
                                    <input type="text" name="product_cost" :value="old('product_cost')"
                                        class="form-control" id="inputPassword4">
                                    <span class="text-danger">
                                        @error('product_cost')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-md-12">
                                    <label for="inputPassword4" class="form-label">Product Type</label>
                                    <input type="text" name="product_type" :value="old('product_type')"
                                        class="form-control" id="inputPassword4">
                                    <span class="text-danger">
                                        @error('product_type')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-block btn-info">Store</button>
                                </div>

                            </form>


                            <div>
                                <br />
                                {{-- show the comment field error notification --}}
                                <b class="text-danger">
                                    @error('comment')
                                        {{ $message }}
                                    @enderror
                                </b>
                                <br /><br />
                                <h1>Product Table</h1>
                                <br />
                                <table id="example" class="table table-dark table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Cost</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                            <th>Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr>
                                                <td></td>
                                                <td>{{ $product->product_name }}</td>
                                                <td>GHs{{ $product->product_cost }}</td>
                                                <td>{{ $product->product_type }}</td>
                                                <td>{{ $product->status }}</td>
                                                <td>
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3">
                                                                @if ($product->status === 'pending')
                                                                    <a href="#publish{{ $product->id }}"
                                                                        data-bs-toggle="modal"
                                                                        class="btn btn-block btn-success">publish</a>
                                                                @else
                                                                    <a href="#unpublish{{ $product->id }}"
                                                                        data-bs-toggle="modal"
                                                                        class="btn btn-block btn-info">draft</a>
                                                                @endif

                                                            </div>
                                                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3">
                                                                <a href="#edit{{ $product->id }}"
                                                                    data-bs-toggle="modal"
                                                                    class="btn btn-block btn-warning">edit</a>
                                                            </div>

                                                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3">
                                                                <a href="#addComment{{ $product->id }}"
                                                                    data-bs-toggle="modal"
                                                                    class="btn btn-block btn-secondary">comment</a>
                                                            </div>

                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                <a href="#delete{{ $product->id }}"
                                                                    data-bs-toggle="modal"
                                                                    class="btn btn-block btn-danger">delete</a>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </td>
                                                <td>{{ $product->created_at }}</td>
                                            </tr>

                                            {{-- including the modals --}}
                                            @include('modals')
                                        @empty
                                            <tr>
                                                <td colspan="6">No Data</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Cost</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                            <th>Timestamp</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
