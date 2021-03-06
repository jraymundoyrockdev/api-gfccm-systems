<?php

require_once 'Kernel.php';

use Illuminate\Contracts\Http\Kernel as KernelContract;

class ApiTestCase extends TestCase
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../../../bootstrap/app.php';

        $app->singleton(KernelContract::class, 'Kernel');

        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

    /**
     * @param null $model
     * @return mixed|string
     */
    public function getContent($model = null)
    {
        $content = $this->response->getContent();

        $json = json_decode($content);

        if (json_last_error() === JSON_ERROR_NONE) {
            $content = $json;
        }

        return (is_null($model)) ? $content : $content->{$model};
    }

    /**
     * void function
     */
    protected function debugContent()
    {
        print_r($this->response->getContent());
        die('end of debug');
    }
}