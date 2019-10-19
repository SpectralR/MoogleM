@extends('layouts.app')

@section('content')
   {{-- <div class='btn-group' role='group'>
       <a href="" type='button' class='btn btn-secondary'>Show event participants</a>
       <a href="" type='button' class='btn btn-secondary'></a>
   </div> --}}
   <h2>Event Management</h2>
   <h4>Who participates in an event</h4>
    <form action="{{ route('list_participants') }}" method='POST'   >
        @csrf
        <select name="event" id="event">
            @foreach ($events as $event)
                <option value="{{ $event->id }}">{{ $event->name }}</option>
            @endforeach
        </select>
        <button type="submit" class='btn btn-outline-success'><i class=' far fa-check-square'></i></button>
    </form>

    <h4>Clean event</h4>
    <a href="{{ route('clean_event') }}" type='button'>Clean!</a>

    @isset($results)
        <h4>List of participating people to {{ $name->name }}</h4>
        @foreach ($results as $participant)
            <p>{{ $participant->username }}</p>
        @endforeach
    @endisset

    <h2>Role Management</h2>
    <form action="{{ route('list_participants') }}" method='POST'   >
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
            <button type="submit" class='btn btn-outline-success'><i class=' far fa-check-square'></i></button>
        </form>

    <h2>Static Management</h2>
@endsection