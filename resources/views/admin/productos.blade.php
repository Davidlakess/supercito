@extends('admin.dashboard')

@section('content')
<productos-admin :productos="{{$productos}}"></productos-admin>
@endsection