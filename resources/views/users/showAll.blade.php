@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Usuários') }}</div>

                <div class="card-body">
                    <ul id="users"></ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    window.onload = function () {
        window.axios.get('/api/users')
            .then((response) => {
                const usersElement = document.getElementById('users');
                let users = response.data;

                users.forEach((user) => {
                    let element = document.createElement('li');
                    element.setAttribute('id', user.id);
                    element.innerText = user.name;
                    usersElement.appendChild(element);
                });
            });

        window.Echo.channel('users')
            .listen('UserCreated', (e) => {
                const usersElement = document.getElementById('users');
                let element = document.createElement('li');
                element.setAttribute('id', e.user.id);
                element.innerText = e.user.name;
                usersElement.appendChild(element);
            })
            .listen('UserUpdated', (e) => {
                const element = document.getElementById(e.user.id);
                element.innerText = e.user.name;
            })
            .listen('UserDeleted', (e) => {
                const element = document.getElementById(e.user.id);
                element.parentNode.removeChild(element);
            });
    };
</script>
@endpush