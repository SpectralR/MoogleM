@extends('layouts.app')

@section('content')
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
   <h2>Event Management</h2>
   <h4>Who participates in an event</h4>
    <form action="{{ route('list_participants') }}" method='POST'   >
        @csrf
        <select name="event" id="event">
            @foreach ($events as $event)
                <option value="{{ $event->id }}">{{ $event->name }}</option>
            @endforeach
        </select>
        <button type="submit" class='btn btn-outline-success'><i nonce="{{ csp_nonce() }}" class=' far fa-check-square'></i></button>
    </form>

    @isset($results)
        <h4>List of participating people to {{ $name->name }}</h4>
        @empty($results)
            <p>no participant yet for this event</p>
        @endempty
        @foreach ($results as $participant)
            <p>{{ $participant->name }}</p>
        @endforeach
    @endisset

   <h4>Clean event</h4>
   <a href="{{ route('clean_event') }}" type='button'>Clean!</a>

    <h2 class="admin-title">Role Management</h2>
    <form action="{{ route('change_role') }}" method='POST'   >
            @csrf
            <select name="user" id="user">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <select name="role" id="role">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            <button type="submit" class='btn btn-outline-success'><i nonce="{{ csp_nonce() }}" class=' far fa-check-square'></i></button>
        </form>

{{--    <h2>Static Management</h2>--}}
@endsection
