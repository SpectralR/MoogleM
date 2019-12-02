@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render('forum') }}
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
            <tr>
                @if(in_array($category->id, $notifs))
                    <td><i class="far fa-comments notif"></i></td>
                @else
                    <td><i class="far fa-comments"></i></td>
                @endif
                <td><a href='/forum/{{ $category->id }}'>{{ $category->name }}</a></td>
                <td class="center-text">{{ $category->topics->count() }}</td>
                @if(count($category->topics) === 0)
                    <td></td>
                @else
                    <td>{{ $category->topics->max()->created_at->format('d-m-Y') }}</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
