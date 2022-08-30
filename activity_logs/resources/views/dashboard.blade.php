<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
                                        <p class="m-b-0">Unpublished Products : <span class="f-right">{{ $pending_products }}</span></p>
                                    </div>
                                </div>
                            </div>

                            @if (auth()->user()->is_admin === 1)
                                <div class="col-md-6 col-xl-6">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">All Users</h6>
                                        <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span>{{ $total_users }}</span></h2>
                                        <p class="m-b-0">Pending Users : <span class="f-right">{{ $inactive_users }}</span></p>
                                    </div>
                                </div>
                            </div>
                            @endif


                            <div>
                            <br /><br />
                            <h1>Activity Logs Table</h1>
                            <br/>
                    <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Activity</th>
                                        <th>Timestamp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($activities as $activity)
                                    <tr>
                                        <td>{!! $activity->activity !!}</td>
                                        <td>{{ $activity->created_at }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Activity</th>
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
