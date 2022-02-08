@extends('ClientSite.master')
@section('title') {{@$page->title}} @endsection

@section('seo')
    <meta name="description" content="{!!@$page->title!!}">
    <meta name="keywords" content="{!!@$page->description!!}">
@endsection

@section('content')

    <section class="section-padding bg-dark inner-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mt-0 mb-3 text-white">{{@$page->title}}</h1>
                    <div class="breadcrumbs">
                        <p class="mb-0 text-white"><a class="text-white" href="#">Home</a> / <span class="text-success">{{@$page->title}}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding bg-white">
        <div class="container">
            <div class="row">
                @if(@$page->image=='default.png')
                    @else
                <div class="pl-4 col-lg-5 col-md-5 pr-4">
                    <img class="rounded img-fluid" src="{{ (@$page->image)?url('upload/Admin/page/'.$page->image):'' }}" alt="Card image cap">
                </div>

                @endif
                <div class="col-lg-6 col-md-6 pl-5 pr-5">

                    <h5 class="mt-2">{{@$page->title}}</h5>
                    {!! @$page->description !!}

                </div>
            </div>
        </div>
    </section>
    @endsection