@extends('layouts/contentNavbarLayout')

@section('title', $title)

@section('content')

    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between pb-3">
                    <div class="col-12">
                        <span class="fs-3">Create Role</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" class="ajax-form"
                    action="{{ $is_edit ? route('roles.update', $data->id) : route('roles.store') }}">
                    @csrf
                    @if ($is_edit)
                        @method('PATCH')
                    @endif
                    <div class="row">
                        <div class="col-md-12 mb-3 required">
                            <label for="" class="form-label">Role Name</label>
                            <input type="text" name="name" id="" class="form-control"
                                value="{{ $is_edit ? $data->name : '' }}" placeholder="Enter role name" />
                        </div>
                    </div>
                    <div class="row">
                        <p>Assign Permissions to Role</p>
                        <div class="form-group col-12">
                            <div class="table-responsive">
                                <table class="table dt-responsive nowrap align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="25%">Module</th>
                                            <th>Permission</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $main = ['users', 'roles'];
                                        @endphp
                                        @foreach ($main as $moduleName)
                                            <tr>
                                                <td scope="row">
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input me-2 all" type="checkbox"
                                                            id="{{ str_replace('_', ' ', $moduleName) }}"
                                                            data-id="{{ str_replace('_', ' ', $moduleName) }}">
                                                        <label class="form-check-label"
                                                            for="{{ str_replace('_', ' ', $moduleName) }}">
                                                            {{ ucfirst(str_replace('_', ' ', $moduleName)) }}
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    @foreach ($permissions as $permission)
                                                        @php
                                                            $words = explode(' ', $permission->name);
                                                            $action = array_shift($words); // Get the action word
                                                            $permissionModuleName = implode(' ', $words); // Get the module name
                                                        @endphp
                                                        @if ($permissionModuleName === $moduleName)
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input me-2" type="checkbox"
                                                                    id="{{ $action . $moduleName }}" name="permissions[]"
                                                                    value="{{ $permission->name }}"
                                                                    data-id="{{ $moduleName }}"
                                                                    {{ $is_edit && in_array($permission->name, $data->permissions->pluck('name')->toArray()) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="{{ $action . $moduleName }}">
                                                                    @php
                                                                        $action = explode('_', $action);
                                                                        $action = implode(' ', $action);
                                                                    @endphp
                                                                    {{ ucfirst($action) }}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 mt-3">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-light me-2"
                                onclick="window.location='{{ route('roles.index') }}'">Cancel</button>
                            <button class="btn btn-primary">{{ $is_edit ? 'Update' : 'Create' }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.all').change(function() {
                var id = $(this).data('id');
                var checkboxes = $('input[type="checkbox"][data-id="' + id + '"]');
                if ($(this).prop('checked')) {
                    checkboxes.each(function() {
                        $(this).prop('checked',
                            true); // Uncheck the checkbox if it's already checked
                    });
                } else {
                    checkboxes.each(function() {
                        $(this).prop('checked',
                            false); // Check the checkbox if it's not already checked
                    });

                }
            });
        });
    </script>
@endsection
