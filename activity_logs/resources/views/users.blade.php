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
                             <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                <div class="card-header">Products</div>
                                <div class="card-body">
                                    <h5 class="card-title">Total Products : {{ $total_products }}</h5>
                                    <hr />
                                    <p class="m-b-0">Unpublished Products : <span
                                            class="f-right">{{ $pending_products }}</span></p>
                                </div>
                            </div>

                &nbsp;&nbsp;&nbsp;&nbsp;
                            @if (auth()->user()->is_admin === 1)
                                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Users</div>
                                    <div class="card-body">
                                        <h5 class="card-title">Total Users : {{ $total_users }}</h5>
                                        <hr />
                                        <p class="m-b-0">Pending Users : <span
                                                class="f-right">{{ $inactive_users }}</span></p>
                                    </div>
                                </div>
                            @endif



                            <div>
                            <br /><br />
                            <h1>Users Table</h1>
                            <br/>
                            <x-alert/>
                    <table id="example" class="table table-dark table-striped" style="width:100%">
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
