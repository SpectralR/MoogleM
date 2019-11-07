@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render('category', $cat) }}
    @auth
            <a href="{{ route('forum_create_topic', ['cat' => $cat]) }}" class="new-topic"><i class="fas fa-comment-medical"></i></a>
    @endauth
    <table class='table table-dark table-hover'>
        <thead>
            <tr>
                <th></th>
                <th>Topic Name</th>
                <th>Topic creation</th>
                <th>Number of messages</th>
                @if (isset($topics->first()->user_id) && $topics->first()->user_id == Auth::user()->id || Auth::user()->isAdministrator() || Auth::user()->isModerator())
                    <th>Lock</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($topics as $topic)
                <tr>
                    @foreach($notifs as $notif)
                        @if($notif == $topic->id)
                            <td><i nounce="{{ csp_nonce() }}" class="far fa-comments notif"></i></td>
                        @else
                            <td><i nounce="{{ csp_nonce() }}" class="far fa-comments"></i></td>
                        @endif
                    @endforeach
                    @empty($notifs)
                            <td><i nounce="{{ csp_nonce() }}" class="far fa-comments"></i></td>
                    @endempty
                    <td><a href="{{ route('forum_messages', ['mes' => $topic->id]) }}">{{ $topic->title }}</a></td>
                    <td>{{ date('d-m-Y', strtotime($topic->created_at)) }}</td>
                    <td class="center-text">{{ $topic->messages->count() }}</td>
                    @if ($topic->user_id == Auth::user()->id || Auth::user()->isAdministrator() || Auth::user()->isModerator())
                        @if ($topic->locked == true)
                            <td><a href="{{ route('unlock_topic', ['topic' => $topic->id]) }}"><i nounce="{{ csp_nonce() }}" class='fas fa-lock'></i></a></td>
                        @else
                            <td><a href="{{ route('lock_topic', ['topic' => $topic->id]) }}"><i nounce="{{ csp_nonce() }}" class='fas fa-lock-open'></i></a></td>
                        @endif
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
