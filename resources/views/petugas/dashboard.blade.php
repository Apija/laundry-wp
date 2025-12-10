@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- Header Card --}}
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <h4 class="text-primary">Welcome Super Admin! 🎉</h4>
                    <p>Haloooo.</p>
                    <a href="#" class="btn btn-outline-primary btn-sm">View Badges</a>
                </div>
                <img src="/assets/img/illustrations/man-with-laptop.png" height="150" />
            </div>
        </div>
    </div>
@endsection
