
@extends ('layout.master')

@section('topNAV')
    @include('layout.topNAV')
@endsection

@section('leftNAV')
    @include('pages.materData.layout.leftNAV_DataMaster')
@endsection
 
@section('mainContent')
  @include('pages.materData.Testing.dataTable')
@endsection

@section('model')
  @include('pages.materData.Testing.create')
  @include('pages.materData.Testing.update') 
@endsection
