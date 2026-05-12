@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tiket #{{ $pemesanans->id }}</h4>
    <p>Status: {{ ucfirst($pemesanans->status) }}</p>
    <div class="mt-3">
        {!! $qr !!}
    </div>
</div>
@endsection
