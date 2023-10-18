<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use \App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    function index(){
        $events = Event::orderBy('id', 'desc')->get();
        return view('Events.EventForm',compact('events'));
    }

    function StoreEvent(Request $request) {
        $request->validate([
            'name' => 'required',
            'team' => 'required',
            'date' => 'required',
            'event' => 'required',
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->team = $request->team;
        $event->date = $request->date;
        $event->event = $request->event;

        $image_code = $request->imageBaseString;
        $basePath = "/emp_images/";
        $fileName = uploadImageWithBase64($image_code, $basePath);
        $image_path = $basePath . $fileName;
        $event->img = $image_path;

        $event->save();

        return redirect('add-events')->with('event', $event);
    }

    function DeleteEvent($id){
        $Event = Event::where('id', $id)->first();
        $Event->delete();
        return back();
    }
}