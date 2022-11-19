<?php

namespace Hotash\Installer\Services;

use Exception;
use Illuminate\Http\Request;
use PDO;
use PDOException;

class EnvironmentManager
{
    private string $envPath;

    private string $envExamplePath;

    public function __construct()
    {
        $this->envPath = base_path('.env');
        $this->envExamplePath = base_path('.env.example');
    }

    public function getEnvContent()
    {
        if (! file_exists($this->envPath)) {
            if (file_exists($this->envExamplePath)) {
                copy($this->envExamplePath, $this->envPath);
            } else {
                touch($this->envPath);
            }
        }

        return file_get_contents($this->envPath);
    }

    /**
     * Save the edited content to the file.
     *
     * @param  Request  $request
     * @return string
     */
    public function saveFile(Request $request)
    {
        $env = $this->getEnvContent();
        $request->merge(['APP_URL' => $request->getSchemeAndHttpHost()]);
        foreach (['APP_URL', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD'] as $key) {
            $env = preg_replace('/'.$key.'=(.+?)?\n/', "$key={$request->get($key)}\n", $env);
        }

        try {
            $dsn = 'mysql:host='.$request->get('DB_HOST').';port='.$request->get('DB_PORT').';dbname='.$request->get('DB_DATABASE');
            $dbh = new PDO($dsn, $request->get('DB_USERNAME'), $request->get('DB_PASSWORD'));

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // First check if database exists
            $dbh->query('CREATE DATABASE IF NOT EXISTS '.$request->get('DB_DATABASE').' CHARACTER SET utf8 COLLATE utf8_general_ci;');

            try {
                file_put_contents($this->envPath, $env);
            } catch (Exception $e) {
                throw $e;
            }

            return true;
        } catch (PDOException|Exception $e) {
            throw $e;
        }
    }
}
