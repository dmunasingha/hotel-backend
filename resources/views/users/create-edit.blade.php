@extends('layouts/contentNavbarLayout')

@section('title', $title)

@section('content')

    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-between pb-3">
                    <div class="col-12">
                        <span class="fs-3">
                            @if ($is_edit)
                                Edit User
                            @else
                                Create User
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ $is_edit ? route('users.update', [$data->id]) : route('users.store') }}" method="POST"
                    class="ajax-form">
                    @csrf
                    @if ($is_edit)
                        @method('PATCH')
                    @endif
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ $is_edit ? $data->name : '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email"
                                value="{{ $is_edit ? $data->email : '' }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Role</label>
                            <select name="role" id="" class="select2 form-control">
                                <option value="">Select</option>
                                @foreach ($roles as $item)
                                    @if ($item->name == 'Super Admin')
                                        @continue
                                    @endif
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $data->roles->first()->id ? 'selected' : '' }}>{{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" {{ $is_edit ? 'readonly' : '' }}>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-end">
                            <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
