@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render('message', $topic) }}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach ($messages as $message)
        <section class='d-flex flex-row-resp post-forum'>
            <aside class='d-flex flex-column align-items-center forum-infos'>
                <a href="{{ route('member', ['id' => $message->user->id]) }}" class="username">{{ $message->user->name}}</a>
                <img src="{{ $message->user->avatar}}" alt="avatar" class='avatar'>
                 @switch($message->user->getRoles()->name)
                    @case('Administrator')
                        <p class='admin'>{{ $message->user->getRoles()->name }}</p>
                        @break
                    @case('Moderator')
                        <p class='modo'>{{ $message->user->getRoles()->name }}</p>
                        @break
                    @case('Banned')
                        <p class='banned'>{{ $message->user->getRoles()->name }}</p>
                        @break
                    @default
                        <p class='member'>{{ $message->user->getRoles()->name }}</p>
                @endswitch
                @if (Auth::user()->isAdministrator() || Auth::user()->isModerator())
                    @if($message->user->isBanned())
                        <a href="{{ route('unban_user', ['id' => $message->user->id ]) }}" title="unban" class="ban"><i class="fas fa-user"></i></a>
                    @else
                        <a href="{{ route('ban_user', ['id' => $message->user->id ]) }}" title="ban" class="ban"><i
                                class="fas fa-user-slash"></i></a>
                    @endif
                @endif
                <dl>
                    <div class='d-flex flex-row margin-1vw'>
                        <dt>Posts:</dt>
                        <dd class="forum-dd">{{ count($message->user->messages) }} </dd>
                    </div>
                    <div class='d-flex flex-row margin-1vw'>
                        <dt>Joined:</dt>
                        <dd class="forum-dd"> {{ $message->user->created_at->format('M Y') }}</dd>
                    </div>
                </dl>

            </aside>
            <article class='message-forum d-flex flex-row-resp'>
                @auth
                    @if ($message->user == Auth::user() || Auth::user()->isAdministrator() || Auth::user()->isModerator())
                        <div class="d-flex flex-row btn-crud-forum">
                            <a href="{{ route('update', ['topic' => $message->topic->id, '$message' => $message->id]) }}" class='btn btn-warning'><i class='far fa-edit'></i></a>
                            <a href="{{ route('delete_message', ['topic' => $message->topic->id, 'id' => $message->id]) }}"
                                class='btn btn-danger'><i class='far fa-trash-alt'></i></a>
                        </div>
                    @endif
                @endauth
                <div class="flex-column">
                    {!! $message->message !!}
                </div>
            </article>
        </section>
    @endforeach

    @auth
        @if ($message->topic->locked == false && Auth::user()->roles() !== 'Banned' )
            <div class="new-mes margin-auto">
                {!! form($form) !!}
            </div>

        @endif
    @endauth
@endsection
