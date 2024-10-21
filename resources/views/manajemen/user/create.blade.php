<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create User</h5>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    @include('components.input', [
                        'label' => 'Nama',
                        'name' => 'name',
                        'type' => 'text',
                    ])
                    @include('components.input', [
                        'label' => 'Email',
                        'name' => 'email',
                        'type' => 'email',
                    ])
                    @include('components.input', [
                        'label' => 'Password',
                        'name' => 'password',
                        'type' => 'password',
                    ])
                    @include('components.input', [
                        'label' => 'Konfirmasi Password',
                        'name' => 'password_confirmation',
                        'type' => 'password',
                    ])
                    @include('components.select', [
                        'label' => 'Roles',
                        'name' => 'role_name',
                        '_data' => $roles,
                        '_item' => 'role',
                        'isArray' => 'Y',
                    ])
                    @include('components.button', ['submit' => 'submit', 'close' => 'close'])
                </form>
            </div>
        </div>
    </div>
</div>
