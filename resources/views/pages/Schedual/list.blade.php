
@extends ('layout.master')

@section('topNAV')
    @include('layout.topNAV')
@endsection

@section('leftNAV')
    @include('layout.leftNAV')
@endsection
 
@section('mainContent')
  @include('pages.Schedual.schedual')
@endsection

@section('model')
  {{-- @include('pages.Schedual.create')
  @include('pages.Schedual.update')  --}}
@endsection

@section('script')
    @viteReactRefresh
    @vite('resources/js/ganttApp.jsx')
@endsection