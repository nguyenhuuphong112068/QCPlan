
@extends ('layout.master')

@section('topNAV')
    @include('layout.topNAV')
@endsection


@section('leftNAV')
    @include('layout.leftNAV')
@endsection
 
@section('mainContent')
  @include('pages.category.SOP.dataTable')
@endsection
@section('model')
  @include('pages.category.SOP.create')
  @include('pages.category.SOP.update') 
@endsection
