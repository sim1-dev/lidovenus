@extends('layouts.app')


@section('content')

@include('layouts.alert')

        <!-- ================ start banner area ================= -->
        <section class="home-banner-area" id="home">

            <div class="container h-100">
            <div class="home-banner">
                <div class="text-center">
                <h4>Lido Venus</h4>
                <h1>Lorem <em>is</em> ipsum</h1>
                <a class="button home-banner-btn" href="{{ url('login') }}">Accedi</a>
                </div>
            </div>
            </div>
        </section>
        <!-- ================ end banner area ================= -->

@endsection
