<?php

namespace Hotash\Installer\Services;

use Illuminate\Support\Collection;

class PermissionChecker
{
    /**
     * @var array
     */
    protected $results = [];

    /**
     * Set the result array permissions and errors.
     *
     * @return mixed
     */
    public function __construct()
    {
        $this->results['permissions'] = [];

        $this->results['errors'] = null;
    }

    /**
     * Check for the folders permissions.
     *
     * @param  array  $folders
     * @return \Illuminate\Support\Collection
     */
    public function check(array $folders): Collection
    {
        return collect($folders)->mapWithKeys(function ($permission, $folder) {
            return [$folder => [$permission, $this->checkPermission(
                $folder, $permission
            )]];
        });
    }

    /**
     * Check a folder permission.
     *
     * @param $folder
     * @param $permission
     * @return bool
     */
    private function checkPermission($folder, $permission)
    {
        return substr(sprintf('%o', fileperms(base_path($folder))), -4) >= $permission;
    }

    /**
     * Add the file to the list of results.
     *
     * @param $folder
     * @param $permission
     * @param $isSet
     */
    private function addFile($folder, $permission, $isSet)
    {
        array_push($this->results['permissions'], [
            'folder' => $folder,
            'permission' => $permission,
            'isSet' => $isSet,
        ]);
    }

    /**
     * Add the file and set the errors.
     *
     * @param $folder
     * @param $permission
     * @param $isSet
     */
    private function addFileAndSetErrors($folder, $permission, $isSet)
    {
        $this->addFile($folder, $permission, $isSet);

        $this->results['errors'] = true;
    }
}
