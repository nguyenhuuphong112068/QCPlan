
@extends ('layout.master')

@section('topNAV')
    @include('layout.topNAV')
@endsection

@section('leftNAV')
    @include('pages.materData.layout.leftNAV_DataMaster')
@endsection
 
@section('mainContent')
  @include('pages.materData.Instrument.dataTable')
@endsection

@section('model')
  @include('pages.materData.Instrument.create')
  @include('pages.materData.Instrument.update') 
@endsection
