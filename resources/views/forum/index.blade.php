@extends('layouts.app')

@section('content')
    <table class='table table-dark table-hover'>
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Number of topics</th>
                <th>Last topic</th>
            </tr>
        </thead>
        <tbody class='margin-1vw'>
            @foreach ($categories as $category)
                {{-- @php
                    dd($category->topics->max()->created_at);
                @endphp --}}
                <tr>
                    <td></td>
                    <td><a href='/forum/{{ $category->id }}'>{{ $category->name }}</a></td>
                    <td>{{ $category->topics->count() }}</td>
                    {{-- <td>{{ $category->topics->max()->created_at }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection