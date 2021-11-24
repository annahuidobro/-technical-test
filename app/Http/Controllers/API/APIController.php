<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\API;

use Anna\AI;
use Anna\GPS;
use Anna\Map;
use Anna\Rover;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Throwable;

class APIController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $rover = new Rover($request->get('initial_orientation'));
            $gps = new GPS();
            $map = new Map($request->get('rectangle_width'), $request->get('rectangle_height'), $gps);

            $gps->savePosition($request->get('initial_x'), $request->get('initial_y'));

            $AI = new AI();
            $AI->createCommands(str_split($request->get('commands')));
            $success = $AI->executeCommands($rover, $gps, $map);
        } catch (Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 400);
        }

        return response()->json(
            [
                'success' => $success,
                'final_orientation' => $rover->orientation(),
                'initialX' => $gps->firstPosition()['x'],
                'initialY' => $gps->firstPosition()['y'],
                'rectangleWidth' => $map->width(),
                'rectangleHeight' => $map->height(),
                'commands' => $AI->commands(),
                'final_position' => $gps->lastPosition(),
                'steps' => $gps->positions(),
            ],
        200);
    }
}
