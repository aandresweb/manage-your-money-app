

@extends('template.template')

@section('content')
    <index-areas-component 
            logout-route="{{ route('auth.logout') }}"
            areas-route="{{ route('areas.index') }}"
            transactions-route="{{ route('transactions.index') }}"
        />
@endsection