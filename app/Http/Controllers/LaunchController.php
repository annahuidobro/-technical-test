<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class LaunchController extends Controller
{
    const VALID_ORIENTATIONS = ['N', 'E', 'S', 'W'];
    const VALID_COMMANDS = ['A', 'L', 'R'];

    public function __invoke(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'initial_orientation' => 'min:1 | max:1',
            'initial_x' => 'required',
            'initial_y' => 'required',
            'rectangle_width' => 'required',
            'rectangle_height' => 'required',
            'commands' => 'required',
        ]);

        $orientation = $request->get('initial_orientation');
        if (in_array($orientation, self::VALID_ORIENTATIONS) === false) {
            throw new Exception('Invalid orientation provided.');
        }

        $initialX = $request->get('initial_x');
        $initialY = $request->get('initial_y');

        if ($initialX < 0 || $initialY < 0) {
            throw new Exception('Invalid initial position provided');
        }

        $rectangleWidth = $request->get('rectangle_width');
        $rectangleHeight = $request->get('rectangle_height');

        if ($rectangleWidth < 0 || $rectangleHeight < 0) {
            throw new Exception('Invalid initial rectangle dimension provided');
        }

        $commands = str_split($request->get('commands'));

        foreach ($commands as $command) {
            if (in_array($command, self::VALID_COMMANDS) === false) {
                throw new Exception('Invalid commands provided.');
            }
        }

        $currentPosition = [
            'x' => $initialX,
            'y' => $initialY,
        ];

        $success = true;
        /*
                dd(
                    $orientation,
                    $initialX,
                    $initialY,
                    $rectangleWidth,
                    $rectangleHeight,
                    $commands
                );*/

        foreach ($commands as $index => $command) {
            if ($command === 'A') {
                $currentPosition = $this->moveRover($currentPosition, $orientation);

                if ($currentPosition['x'] > $rectangleWidth || $currentPosition['y'] > $rectangleHeight) {
                    return false;
                    /* dd(
                         'Crash',
                         $orientation,
                         $initialX,
                         $initialY,
                         $rectangleWidth,
                         $rectangleHeight,
                         $commands,
                         $command,
                         $index
                     );*/
                }
            } else {
                $orientation = $this->turnRover($command, $orientation);
            }
        }

        return view('result', [
            'final_orientation' => $orientation,
            'initialX' => $initialX,
            'initialY' => $initialY,
            'rectangleWidth' => $rectangleWidth,
            'rectangleHeight' => $rectangleHeight,
            'commands' => json_encode($commands),
            'success' => $success,
            'final_position' => json_encode($currentPosition), ]);
        /*dd(
            'All right!',
            'orientation = '.$orientation,
            'initialX = '.$initialX,
            'initialY = '.$initialY,
            'rectangleWidth = '.$rectangleWidth,
            'rectangleHeight = '.$rectangleHeight,
            'commands = '.json_encode($commands)
        );*/
    }

    private function moveRover(array $position, string $orientation): array
    {
        switch ($orientation) {
            case 'N':
                $position['x']++;
                break;
            case 'E':
                $position['y']++;
                break;
            case 'S':
                $position['x']--;
                break;
            case 'W':
                $position['y']--;
                break;
        }

        return $position;
    }

    private function turnRover(string $command, string $orientation): string
    {
        if ($command === 'L' && $orientation === 'N') {
            $orientation = 'W';
        }

        if ($command === 'L' && $orientation === 'E') {
            $orientation = 'N';
        }

        if ($command === 'L' && $orientation === 'S') {
            $orientation = 'E';
        }

        if ($command === 'L' && $orientation === 'W') {
            $orientation = 'S';
        }

        if ($command === 'R' && $orientation === 'N') {
            $orientation = 'E';
        }

        if ($command === 'R' && $orientation === 'E') {
            $orientation = 'S';
        }

        if ($command === 'R' && $orientation === 'S') {
            $orientation = 'W';
        }

        if ($command === 'R' && $orientation === 'W') {
            $orientation = 'N';
        }

        return $orientation;
    }
}
