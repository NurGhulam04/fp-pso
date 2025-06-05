<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;

class MetricsController extends Controller
{
    public function index()
    {
        // Gunakan storage InMemory (untuk demo, sebaiknya pakai Redis untuk production)
        $registry = new CollectorRegistry(new InMemory());

        // Cek apakah counter sudah ada, kalau belum, register baru
        $counter = $registry->registerCounter(
            'app',                    // namespace
            'requests_total',         // name
            'Total number of requests.', // help text
            []                        // label names
        );

        $counter->inc(); // Tambahkan 1 ke counter

        // Render output Prometheus
        $renderer = new RenderTextFormat();
        $metrics = $renderer->render($registry->getMetricFamilySamples());

        return response($metrics, 200)->header('Content-Type', RenderTextFormat::MIME_TYPE);
    }
}
