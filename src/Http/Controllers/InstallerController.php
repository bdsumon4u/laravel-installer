<?php

namespace Hotash\Installer\Http\Controllers;

use Hotash\Installer\Services\PermissionChecker;
use Hotash\Installer\Services\RequirementChecker;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;

class InstallerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('installer::initial');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function requirements(Request $request, RequirementChecker $checker)
    {
        $phpSupportInfo = $checker->checkPHPversion(
            config('installer.core.minPhpVersion')
        );

        $requirements = collect(['PHP Version >= '.$phpSupportInfo['minimum'] => $phpSupportInfo['supported']])
            ->merge($checker->check(config('installer.requirements')));

        $installable = $phpSupportInfo['supported'];
        if ($requirements->first(fn ($item) => $item === false)) {
            $installable = false;
        }

        return view('installer::requirements', [
            'requirements' => $requirements,
            'installable' => $installable,
        ]);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function permissions(Request $request, PermissionChecker $checker)
    {
        $permissions = $checker->check(
            config('installer.permissions')
        );

        return view('installer::permissions', [
            'permissions' => $permissions,
            'installable' => ! $permissions->first(function ($item) {
                return Arr::first($item) === false;
            }),
        ]);
    }

    public function finish(Request $request)
    {
        file_put_contents(storage_path('app/installed'), 'INSTALLED on '.date('d-M-Y H:i:s A')."\n");

        Artisan::call('migrate', ['--seed' => true]);

        return view('installer::finish');
    }
}
