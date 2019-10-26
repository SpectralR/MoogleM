@extends('layouts.app')

@section('content')

<section class='char-card flex-column'>
    {{-- @php
     dd($user);
    @endphp --}}
    <h2 class="char-title">{{ $user->name }}</h2>
    <h3 class="char-title">{{ $char->Character->Name }}</h3>
    <div class='d-flex flex-row char-gear'>
        <div class='d-flex flex-column'>
            {{-- foreach for weapons --}}
            @foreach ($char->Character->GearSet->Gear as $item)
                {{-- @php
                    dd($item);
                @endphp --}}
                @if ($item->Item->ItemUICategory->ID > 33 )
                    @continue
                @else
                    <img src="https://xivapi.com{{ $item->Item->Icon }}" alt="gear-icon" class='gear-icon' title='{{ $item->Item->Name }}'>
                @endif

            @endforeach

            {{-- foreach for armors --}}
            @foreach ($char->Character->GearSet->Gear as $item)
                {{-- @php
                    dd($item);
                @endphp --}}
                @if ( $item->Item->ItemUICategory->ID > 39 || $item->Item->ItemUICategory->ID < 34)
                    @continue
                @else
                    <img src="https://xivapi.com{{ $item->Item->Icon }}" alt="gear-icon" class='gear-icon' title='{{ $item->Item->Name }}'>
                @endif

            @endforeach
        </div>
        <img src='{{ $char->Character->Portrait}}' alt="portrait" class='char-pic'>
        <div class='d-flex flex-column'>
            {{-- foreach for accessories --}}
            @foreach ($char->Character->GearSet->Gear as $item)
                @if ($item->Item->ItemUICategory->ID < 40  || $item->Item->ItemUICategory->ID > 50 )
                    @continue
                @else
                    <img src="https://xivapi.com{{ $item->Item->Icon }}" alt="gear-icon" class='gear-icon' title='{{ $item->Item->Name }}'>
                @endif

            @endforeach
        </div>
        <div class="current-job">
            <h4>Current Job</h4>
            <img src="https://xivapi.com{{ $char->Character->ActiveClassJob->Job->Icon }}" alt="" class='job-icon'>
            <p>{{ $char->Character->ActiveClassJob->Level }}</p>
        </div>
    </div>

    <table class="class">
        <tbody class="classes">
            <tr>
                @foreach ($char->Character->ClassJobs as $job)
                    @if ($job->Job->ID === $char->Character->ActiveClassJob->Job->ID)
                        @continue
                    @endif
                    <td><img src="https://xivapi.com{{ $job->Job->Icon }}" alt="" class='job-icon'></td>
                @endforeach
            </tr>
            <tr>
                @foreach ($char->Character->ClassJobs as $job)
                    @if ($job->Job->ID === $char->Character->ActiveClassJob->Job->ID)
                        @continue
                    @endif
                    <td>{{$job->Level}}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</section>
@endsection
