<?php

namespace Hotash\Installer\Http\Controllers;

use Hotash\Installer\Services\EnvironmentManager;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, EnvironmentManager $manager)
    {
        if ($request->isMethod('GET')) {
            return view('installer::config');
        }

        $request->validate([
            'DB_HOST' => 'required',
            'DB_PORT' => 'required|integer',
            'DB_DATABASE' => 'required',
            'DB_USERNAME' => 'required',
            'DB_PASSWORD' => 'required',
        ], [], [
            'DB_HOST' => 'host',
            'DB_PORT' => 'port',
            'DB_DATABASE' => 'database',
            'DB_USERNAME' => 'username',
            'DB_PASSWORD' => 'password',
        ]);

        try {
            $manager->saveFile($request);

            return redirect()->action([InstallerController::class, 'finish']);
        } catch (\Throwable $th) {
            return back()->withErrors(['database' => 'Could not connect to the database.']);
        }
    }
}
