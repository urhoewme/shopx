<?php

namespace App\Providers;

use App\Jobs\TestJob;
use App\Mail\CsvExportedMail;
use App\Models\Product;
use Aws\S3\S3Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Csv\Writer;
use Illuminate\Contracts\Foundation\Application;
use Aws\S3\S3ClientInterface;

class ProductExportService extends ServiceProvider
{
    /**
     * Register services.
     */

    protected $s3Client = S3ClientInterface::class;

    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    public function register(): void
    {
        //
    }

    public function export($filename)
    {
        $localCsvPath = storage_path('../storage/' . $filename);
        $localCsv = Writer::createFromPath($localCsvPath, 'w+');
        $localCsv->insertOne(['Title', 'Price']);
        $products = Product::all(['title', 'price']);
        foreach ($products as $product) {
            $localCsv->insertOne($product->toArray());
        }
        TestJob::dispatch($localCsvPath);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
