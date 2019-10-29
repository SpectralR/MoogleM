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
{{--                @php--}}
{{--                    dd($category->topics->max());--}}
{{--                @endphp--}}
                <tr>
                    @foreach($notifs as $notif)
                        @if($notif == $category->id)
                            <td><i class="far fa-comments notif"></i></td>
                        @else
                            <td><i class="far fa-comments"></i></td>
                        @endif
                    @endforeach
                    @empty($notifs)
                        <td><i class="far fa-comments"></i></td>
                    @endempty
                    <td><a href='/forum/{{ $category->id }}'>{{ $category->name }}</a></td>
                    <td>{{ $category->topics->count() }}</td>
                    <td>{{ $category->topics->max()->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
