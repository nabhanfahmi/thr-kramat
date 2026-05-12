@extends('admin.layout.admin')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>

    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Galeri</div>
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-sm btn-primary mt-2">Kelola Galeri</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Tiket</div>
                    <a href="{{ route('admin.tiket.index') }}" class="btn btn-sm btn-success mt-2">Kelola Tiket</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Background</div>
                    <a href="{{ route('admin.hero.index') }}" class="btn btn-sm btn-warning mt-2">Edit Background</a>
                </div>
            </div>
        </div>

    </div>
@endsection
