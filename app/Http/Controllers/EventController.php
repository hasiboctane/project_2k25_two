<?php

namespace App\Http\Controllers;

use App\Http\Requests\events\StoreEventRequest;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller implements HasMiddleware
{
        public static function middleware(){
        return [
            new Middleware('permission:view events', only: ['index', 'show']),
            new Middleware('permission:create events', only: ['create', 'store']),
            new Middleware('permission:edit events', only: ['edit', 'update']),
            new Middleware('permission:delete events', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.events.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        // $request->validated();
        $bannerPath = null;
        if($request->hasFile(('event_banner'))){
            $orginalBanner = $request->file('event_banner');
            $bannerName = 'event-'.time() . '.' . $orginalBanner->extension();
            $bannerPath = $orginalBanner->storeAs('events', $bannerName, 'public');
        }
        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->category_id = $request->category_id;
        $event->event_banner = $bannerPath;
        $event->type = $request->type;
        $event->location = $request->location;
        $event->price = $request->price;
        $event->max_capacity = $request->max_capacity;
        $event->start_time = $request->start_date;
        $event->end_time = $request->end_date;
        $event->save();
        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        try{
            if($event->event_banner){
                Storage::disk('public')->delete($event->event_banner);
            }
            $event->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Event deleted successfully'
            ]);
        }catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete event'
            ], 500);
        }
    }
}
