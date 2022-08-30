<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>

    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-xl-6">
                                <div class="card bg-c-blue order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">All Products</h6>
                                        <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>{{ $total_products }}</span>
                                        </h2>
                                        <p class="m-b-0">Published Products : <span class="f-right">{{ $pending_products }}</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">All Users</h6>
                                        <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span>{{ $total_users }}</span></h2>
                                        <p class="m-b-0">Pending Users : <span class="f-right">{{ $inactive_users }}</span></p>
                                    </div>
                                </div>
                            </div>



                            <div>
                            <br /><br />
                            <h1>Users Table</h1>
                            <br/>
                            <x-alert/>
                    <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                        <div class="col-3">
                                            @if ($user->status === 'inactive')
                                                <b class="text-danger">{{ $user->status }}</b>
                                            @else
                                                <b class="text-success">{{ $user->status }}</b>
                                            @endif
                                        </td>
                                        <td>
                                        <div class="row">
                                            <div class="col-3">
                                            @if ($user->status === 'inactive')
                                                <a href="{{ route('status') }}/{{ $user->id }}" class="btn btn-block btn-success">Active</a>
                                            @else
                                                <a href="{{ route('status') }}/{{ $user->id }}" class="btn btn-block btn-danger">InActive</a>
                                            @endif

                                            </div>
                                            {{-- <div class="col-3">
                                            <form method="post" action="{{route('destroy')}}">
                                                @csrf
                                                <input hidden name="id" value="{{ $user->id }}" />
                                                <button type="submit" class="btn btn-block btn-danger">Delete</button>
                                            </form>
                                            </div> --}}
                                            </div>
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
