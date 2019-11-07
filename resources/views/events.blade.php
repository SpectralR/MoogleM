@extends('layouts.app')

@section('content')

    @auth
        @if ( Auth::user()->isAdministrator())
            <a href="/admin/event" type='button' class='btn btn-secondary'>Add An Event</a>
        @endif
        @isset($form)
        {!! form($form) !!}
        @endisset
    @endauth
    @if (!isset($form))
        <div class="d-flex flex-row flex-wrap">
            @isset($user->events)
                @foreach($user->events as $event)
                    @if ($event->date < now())

                    @else
                        @if($event->pivot->participate == 'y')
                            <div class="card event border-success mb-3">
                                <div class="card-header bg-transparent border-success"><h3>{{ $event->name }}</h3></div>
                                <div class="card-body">
                                    <h5>{{ $event->date }}</h5>
                                    <p class="card-text">{{ $event->description }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-success">
                                    <form method='post' action='/events' class='d-flex flex-row'>
                                        @csrf
                                        <input type="hidden" name="eventId" value='{{ $event->id }}'>
                                        <div class="radio">
                                            <input type="radio" name='participate'id='y' value='y' checked disabled>
                                            <label for='y'>Yes</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name='participate' id='n' value='n' disabled>
                                            <label for='n'>No</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @elseif($event->pivot->participate == 'n')
                            <div class="card event border-danger mb-3">
                                <div class="card-header bg-transparent border-danger"><h3>{{ $event->name }}</h3></div>
                                <div class="card-body">
                                    <h5>{{ $event->date }}</h5>
                                    <p class="card-text">{{ $event->description }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-danger">
                                    <form method='post' action='/events' class='d-flex flex-row'>
                                        @csrf
                                        <input type="hidden" name="eventId" value='{{ $event->id }}'>
                                        <div class="radio">
                                            <input type="radio" name='participate'id='y' value='y' disabled>
                                            <label for='y'>Yes</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name='participate' id='n' value='n' checked disabled>
                                            <label for='n'>No</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                        <div class="card event border-light mb-3">
                                <div class="card-header bg-transparent border-light"><h3>{{ $event->name }}</h3></div>
                                <div class="card-body">
                                    <h5>{{ $event->date }}</h5>
                                    <p class="card-text">{{ $event->description }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-light">
                                    <form method='post' action='/events' class='d-flex flex-row'>
                                        @csrf
                                        <input type="hidden" name="eventId" value='{{ $event->id }}'>
                                        <div class="radio">
                                            <input type="radio" name='participate'id='y' value='y'>
                                            <label for='y'>Yes</label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name='participate' id='n' value='n'>
                                            <label for='n'>No</label>
                                        </div>
                                        <button type='submit' class='btn btn-outline-success event-validate'><i nounce="{{ csp_nonce() }}" class=' far fa-check-square'></i></button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            @endisset
        </div>
    @endif
@endsection
