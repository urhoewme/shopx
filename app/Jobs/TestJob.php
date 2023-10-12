<?php

namespace App\Jobs;

use App\Mail\CsvExportedMail;
use Aws\S3\S3Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

/**
 * If you faced some problems with localstack ses you should check the localstack logs
 * in docker and probably there would be an error with problems of authority of sender email
 * you should execute command `awslocal ses verify-email-identity --email sender@example.com`
 */
class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private string $data;

    public function __construct($data)
    {
        $this->data = file_get_contents($data);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->data) {
            $s3 = new S3Client([
                'version' => 'latest',
                'region' => $_ENV['AWS_DEFAULT_REGION'],
                'endpoint' => $_ENV['AWS_ENDPOINT'],
                'use_path_style_endpoint' => true,
                'credentials' => [
                    'key' => $_ENV['AWS_ACCESS_KEY_ID'],
                    'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
                ],
            ]);
            Mail::to('gheniavip@gmail.com')->send(new CsvExportedMail());
            $bucketName = $_ENV['AWS_BUCKET'];
            $s3->createBucket(['Bucket' => $bucketName]);
            try {
                $s3->putObject([
                    'Bucket' => $_ENV['AWS_BUCKET'],
                    'Key' => 'products',
                    'Body' => $this->data,
                ]);
            } catch (Throwable $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}

