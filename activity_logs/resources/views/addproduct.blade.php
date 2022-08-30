<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if ($showEditForm) {{ __('Edit Product Section') }} @else {{ __('Add Product Section') }} @endif
        </h2>

    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-alert/>
                    <div class="container">
                        <div class="row">

                            @if ($showEditForm)
                                <form class="row g-3" method="post" action="{{ route('update') }}">
                                {{-- @method('PATCH') --}}
                            @csrf
                            <input type="text" hidden name="id" value="{{ $product_data['id'] }}" class="form-control" id="inputEmail4">

                                <div class="col-md-12">
                                    <label for="inputEmail4" class="form-label">Product Name</label>
                                    <input type="text" name="product_name" value="{{ $product_data['name'] }}" class="form-control" id="inputEmail4">
                                    <span class="text-danger">
                                    @error('product_name')
                                        {{ $message }}
                                    @enderror
                                    </span>
                                </div>

                                <div class="col-md-12">
                                    <label for="inputPassword4" class="form-label">Product Cost</label>
                                    <input type="text" name="product_cost" value="{{ $product_data['cost'] }}" class="form-control" id="inputPassword4">
                                    <span class="text-danger">
                                    @error('product_cost')
                                        {{ $message }}
                                    @enderror
                                    </span>
                                </div>

                                <div class="col-md-12">
                                    <label for="inputPassword4" class="form-label">Product Type</label>
                                    <input type="text" name="product_type" value="{{ $product_data['type'] }}" class="form-control" id="inputPassword4">
                                    <span class="text-danger">
                                    @error('product_type')
                                        {{ $message }}
                                    @enderror
                                    </span>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-block btn-warning">Update</button>
                                </div>

                            </form>
                            @else
                                <form class="row g-3" method="post" action="{{ route('store') }}">
                            @csrf
                                <div class="col-md-12">
                                    <label for="inputEmail4" class="form-label">Product Name</label>
                                    <input type="text" name="product_name" :value="old('product_name')" class="form-control" id="inputEmail4">
                                    <span class="text-danger">
                                    @error('product_name')
                                        {{ $message }}
                                    @enderror
                                    </span>
                                </div>

                                <div class="col-md-12">
                                    <label for="inputPassword4" class="form-label">Product Cost</label>
                                    <input type="text" name="product_cost" :value="old('product_cost')" class="form-control" id="inputPassword4">
                                    <span class="text-danger">
                                    @error('product_cost')
                                        {{ $message }}
                                    @enderror
                                    </span>
                                </div>

                                <div class="col-md-12">
                                    <label for="inputPassword4" class="form-label">Product Type</label>
                                    <input type="text" name="product_type" :value="old('product_type')" class="form-control" id="inputPassword4">
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
                            @endif




                            <div>
                                <br/><br/>
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
                                            <div class="col-xs-2 col-sm-4 col-md-4 col-lg-4">
                                            @if ($product->status === 'pending')
                                                <a href="{{ route('product_status') }}/{{ $product->id }}" class="btn btn-block btn-success">Publish</a>
                                            @else
                                                <a href="{{ route('product_status') }}/{{ $product->id }}" class="btn btn-block btn-info">Draft</a>
                                            @endif

                                            </div>
                                            <div class="col-xs-2 col-sm-4 col-md-4 col-lg-4">
                                            <a href="{{ route('edit') }}/{{ $product->id }}" class="btn btn-block btn-warning">edit</a>
                                            </div>
                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                            <form method="post" action="{{route('destroy')}}">
                                                {{-- @method('delete') --}}
                                                @csrf
                                                <input hidden name="id" value="{{ $product->id }}" />
                                                <button type="submit" class="btn btn-block btn-danger">Delete</button>
                                            </form>
                                            </div>
                                            </div>
                                            </div>


                                            </td>
                                            <td>{{ $product->created_at }}</td>
                                        </tr>
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
