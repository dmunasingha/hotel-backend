@extends('layouts/contentNavbarLayout')

@section('title', $title)

@section('content')

    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between pb-3">
                    <div class="col-12">
                        <span class="fs-3">All Roles</span>
                        <a href="{{ route('roles.create') }}" class="btn btn-primary shadow-sm float-end">
                            Create <i class="bx bx-plus ps-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle" id="datatable">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                @if ($item->name == 'Super Admin')
                                    @continue
                                @endif
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @foreach ($item->permissions as $permission)
                                            <span
                                                class="badge bg-label-primary fw-normal rounded-pill m-1">{{ $permission->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('roles.edit', [$item->id]) }}"class="link-secondary btn btn-sm btn-icon"
                                            data-bs-toggle="tooltip" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" data-url="{{ route('roles.edit', [$item->id]) }}"
                                            class="link-danger btn btn-sm btn-icon delete_confirm" data-bs-toggle="tooltip"
                                            title="Delete">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection