@extends('dashboard.layout.master')
@section('content')


<!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    @include('dashboard.layout.navbar')
    <!-- Navbar End -->



    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Edit Tehsil</h6>
                    <form method="post" action="{{route('tehsil.update',[$tehsil->id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" value="{{$tehsil->name}}" name="name">
                            </div>
                            <div class="mb-3 col-6">
                                <label class="form-label">District</label>
                                <select name="districts_id"  class="form-control">
                                    @foreach ($district as $item)
                                    <option value="{{$item->id}}"  {{$item->id==$tehsil->districts_id ? 'selected' : ''}} > {{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                toast: true,         // This enables the toast mode
                position: 'top-end', // Position of the toast
                showConfirmButton: false, // Hides the confirm button
                timer: 3000          // Time to show the toast in milliseconds
            });
        </script>
    @endif
    @if(session('success'))
        <script>

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif
    @endsection