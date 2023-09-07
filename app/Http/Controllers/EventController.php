<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddEventRequest;
use App\Models\Event;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Event::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AddEventRequest $request)
    {
        try {
            Event::create([
                'title'   => $request->title,
                'start'   => Carbon::parse($request->start),
                'end'     => Carbon::parse($request->end),
                'all_day' => $request->allDay,
            ]);
            return response('OK', 201);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

}
