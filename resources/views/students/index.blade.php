@extends('layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Student List</h3>
            <form action="{{ route('students.index') }}" method="GET" class="form-inline">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by name, email or city..."
                           value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Search
                        </button>
                        @if(request('search'))
                        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary ml-2">
                            <i class="fas fa-times"></i> Clear
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->city->name }}</td>
                    <td>
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
                </table>
            </div>

            @if($students->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} entries
                </div>
                <nav>
                    <ul class="pagination mb-0">
                        <li class="page-item {{ $students->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $students->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        @foreach ($students->getUrlRange(1, $students->lastPage()) as $page => $url)
                            <li class="page-item {{ $students->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <li class="page-item {{ !$students->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $students->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            @endif
        </div>
        <div class="card-footer text-right">
            <a href="{{ route('students.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Add New Student
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@if(session('success'))
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 3000);
    });
</script>
@endif
@endsection
