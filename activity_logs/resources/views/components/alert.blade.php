<div>
    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @elseif(session()->has('noti'))
                        <div class="alert alert-warning">
                            {{ session()->get('noti') }}
                        </div>
                    @elseif(session()->has('error'))
                    <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
</div>
