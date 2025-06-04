<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory; // Untuk demo, storage bisa diganti Redis untuk produksi

class MetricsController extends Controller
{
    public function index()
    {
        // Storage: in-memory hanya untuk testing/demo
        $registry = new CollectorRegistry(new InMemory());

        // Contoh metric: counter
        $counter = $registry->registerCounter('app', 'requests_total', 'Total number of requests.');
        $counter->inc(); // +1 setiap akses

        // Render ke format Prometheus
        $renderer = new RenderTextFormat();
        $metrics = $renderer->render($registry->getMetricFamilySamples());

        return response($metrics, 200)->header('Content-Type', RenderTextFormat::MIME_TYPE);
    }
}
