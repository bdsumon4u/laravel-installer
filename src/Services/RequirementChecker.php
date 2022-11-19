<?php

namespace Hotash\Installer\Services;

use Illuminate\Support\Collection;

class RequirementChecker
{
    /**
     * Check for the server requirements.
     *
     * @param  array  $requirements
     * @return \Illuminate\Support\Collection
     */
    public function check(array $requirements): Collection
    {
        return collect($requirements)->mapWithKeys(function ($item, $key) {
            return [$item => extension_loaded($item)];
        });
    }

    public function checkPHPversion(string $minPhpVersion): array
    {
        $supported = false;
        $currentPhpVersion = $this->getPhpVersionInfo();

        if (version_compare($currentPhpVersion['version'], $minPhpVersion) >= 0) {
            $supported = true;
        }

        return [
            'full' => $currentPhpVersion['full'],
            'current' => $currentPhpVersion['version'],
            'minimum' => $minPhpVersion,
            'supported' => $supported,
        ];
    }

    /**
     * Get current Php version information
     *
     * @return array
     */
    private static function getPhpVersionInfo()
    {
        $currentVersionFull = PHP_VERSION;
        preg_match("#^\d+(\.\d+)*#", $currentVersionFull, $filtered);
        $currentVersion = $filtered[0];

        return [
            'full' => $currentVersionFull,
            'version' => $currentVersion,
        ];
    }
}
