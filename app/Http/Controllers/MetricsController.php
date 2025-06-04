<?php

namespace App\Http\Controllers;

use Prometheus\CollectorRegistry;
use Prometheus\Storage\InMemory;
use Prometheus\RenderTextFormat;
use Illuminate\Http\Response;

class MetricsController extends Controller
{
    public function metrics()
    {
        $registry = new CollectorRegistry(new InMemory());

        $counter = $registry->getOrRegisterCounter(
            'app',
            'http_requests_total',
            'Total HTTP requests',
            ['method', 'endpoint']
        );

        $counter->inc(['GET', '/metrics']);

        $renderer = new RenderTextFormat();
        $result = $renderer->render($registry->getMetricFamilySamples());

        return response($result, 200)
            ->header('Content-Type', RenderTextFormat::MIME_TYPE);
    }
}

