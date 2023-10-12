<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;


class AdminTerminalController extends Controller
{
    public function index()
    {
        return view('admin_dashboard.terminal.index');
    }

    public function migrate()
    {
        Artisan::call('migrate', ["--force"=> true ]);

        return redirect()->route('admin.terminal.index')->with('success', 'Command "php artisan migrate" was ran successfully.');
    }

    public function migrateStatus()
    {
        Artisan::call('migrate:status');
        $output = Artisan::output();

        // Split the output into lines
        $lines = explode(PHP_EOL, $output);

        // Process each line to limit dots to 5 and add a line break
        $formattedLines = array_map(function ($line) {
            // Limit dots to 5
            $line = preg_replace('/\.{6,}/', '.....', $line);
            return $line;
        }, $lines);

        // Join the processed lines into a single string
        $migrations = implode(' ', $formattedLines);

        return redirect()->route('admin.terminal.index')->with('info', 'Command "php artisan migrate:status" was ran successfully.' . PHP_EOL . $migrations);
    }

}
