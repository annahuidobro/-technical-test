<?php

namespace App\Http\Controllers;

use Anna\AI;
use Anna\GPS;
use Anna\Map;
use Anna\Rover;
use Illuminate\Http\Request;

class LaunchController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'initial_orientation' => 'min:1 | max:1',
            'initial_x'           => 'required',
            'initial_y'           => 'required',
            'rectangle_width'     => 'required',
            'rectangle_height'    => 'required',
            'commands'            => 'required',
        ]);

        $rover = new Rover($request->get('initial_orientation'));
        $gps   = new GPS();
        $map   = new Map($request->get('rectangle_width'), $request->get('rectangle_height'), $gps);

        $gps->savePosition($request->get('initial_x'), $request->get('initial_y'));

        $AI = new AI();
        $AI->createCommands(str_split($request->get('commands')));
        $success = $AI->executeCommands($rover, $gps, $map);

        return view('result', [
            'final_orientation' => $rover->orientation(),
            'initialX'          => $gps->firstPosition()['x'],
            'initialY'          => $gps->firstPosition()['y'],
            'rectangleWidth'    => $map->width(),
            'rectangleHeight'   => $map->height(),
            'commands'          => json_encode($AI->commands()),
            'success'           => $success,
            'final_position'    => json_encode($gps->lastPosition()),
            'steps'             => $gps->positions(),
        ]);
    }
}