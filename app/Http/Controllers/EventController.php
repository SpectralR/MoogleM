<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use DateTime;
use App\Event;
use App\Forms\EventForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepoInterface;
use App\Repositories\EventRepoInterface;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class EventController extends Controller
{

    /**
     * @return event view
     */
    public function event()
    {
        $events = Event::get();
        $user = Auth::user();

        return view('events', ['events' => $events, 'user'=> $user]);
    }

    /**
     * @param request
     * @return event route after adding participants
     */
    public function participate(Request $request)
    {

        $user = Auth::user();
        $user->events()->updateExistingPivot($request->request->get('eventId'), ['participate' => $request->request->get('participate')]);

        return redirect()->route('events');
    }


    /**
     * @param FormBuilder
     * @return event view to add one
     */
    use FormBuilderTrait;
    public function addEvent(FormBuilder $formBuilder)
    {
        $form = $this->form(EventForm::class,[
            'method' =>'POST',
            'route' => 'storeEvent'
        ]);

        return view('events', compact('form'));
    }


    /**
     * stores an event
     * @param request
     */
    public function storeEvent(Request $request)
    {

        $form = $this->form(EventForm::class);

        $validateData = $request->validate([
            'name' => 'string|required|max:50',
            'description' => 'string|required',
            'date' => 'date|required'
        ]);

        if($form->isValid()) {
            $date = $request->date . ' ' . $request->hour;
            $datetime = new DateTime($date);

            $event = new Event([
                'name' => $request->name,
                'description' => $request->description,
                'date' => $datetime
            ]);
            $event->save();

            $users = User::all();
            foreach ($users as $user) {
                $user->events()->attach($event->id);
            }

            return redirect()->route('events');
        }
    }

    /**
     * @param Request
     * @return view with all participant to an event
     */
    public function listParticipants(Request $request)
    {
        $users = User::select('id', 'name')->get();
        $roles = Role::select('id', 'name')->get();
        $events = Event::select('id', 'name')->get();
        $event = Event::find($request->event);
        $eventParticipants = Event::join('event_user', 'event_id', '=', 'events.id')
            ->where('id', $event->id)
            ->where('participate', '=', 'y')
            ->get();
        $participants = [];

        foreach ($eventParticipants as $participant) {
            $user = User::find($participant->user_id);
            $participants[] = $user;
        }

        return view('admin', [
            'events' => $events,
            'name' => $event,
            'results' => $participants,
            'users' => $users,
            'roles' => $roles
        ]);
    }

    /**
     * cleans event from db
     */
    public function cleanEvent()
    {
        $events = DB::table('events')->get();
        $users = DB::table('users')->get();

        foreach ($events as $event) {
            if ($event->date < now()) {
                foreach ($users as $user) {
                    $user->events()->detach($event->id);
                }
                DB::tables('events')->where($event->id)->delete();
            }
        }
        return redirect()->route('admin');
    }
}
