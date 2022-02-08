@extends('ClientSite.master')

@section('title') {{@$meta->home_meta_title}} @endsection

@section('seo')
    <meta name="description" content="{!!@$meta->home_meta_des!!}">
    <meta name="keywords" content="{!!@$meta->home_meta_des!!}">
@endsection



@section('Slider')
    <x-Slider :slider="$slider" />
@endsection

@section('category_section')
    <x-Category :category="$category" />
@endsection

@section('about')
    <x-About :about="$about" />
@endsection

@section('product')
    <x-Product :section="$section" :product="$product" />
@endsection

@section('client-us')
  <x-ClientUs :ourclient="$ourclient" />
@endsection