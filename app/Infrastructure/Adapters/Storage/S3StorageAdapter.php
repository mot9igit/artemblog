<?php


namespace App\Infrastructure\Adapters\Storage;
use App\Core\Domain\Exceptions\Storage\StorageDeleteException;
use App\Core\Domain\Exceptions\Storage\StorageFileNotFoundException;
use App\Core\Domain\Exceptions\Storage\StorageUploadException;
use App\Core\Ports\Storage\FileUploadInput;
use App\Core\Ports\Storage\StoragePort;
use Aws\S3\Exception\S3Exception;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class S3StorageAdapter implements StoragePort
{
    private string $driver;
    private string $url;

    public function __construct()
    {
        $this->driver = config('filesystems.default', 'tws3');
        $this->url = config("filesystems.disks.{$this->driver}.url");

        if (empty($this->url)) {
            throw new \RuntimeException('Storage URL is not configured (TW_URL missing)');
        }
    }

    public function save(FileUploadInput $input): void
    {
        try {
            $result = Storage::disk($this->driver)->put($input->key, $input->buffer, [
                'ContentType' => $input->mimeType,
            ]);

            if (!$result) {
                throw new StorageUploadException('put вернул false');
            }
        } catch (Exception $error) {
            Log::error($error->getMessage());
            throw new StorageUploadException($error->getMessage());
        }
    }

    public function get(string $key): string
    {
        try {
            return $this->url . '/' . $key;
        } catch (S3Exception $error) {
            if ($error->getAwsErrorCode() === 'NotFound') {
                throw new StorageFileNotFoundException($error->getMessage());
            }

            throw $error;
        }
    }

    public function remove(string $key): void
    {
        try {
            Storage::disk($this->driver)->delete($key);
        } catch (S3Exception $error) {
            if ($error->getAwsErrorCode() === 'NotFound') {
                throw new StorageFileNotFoundException($error->getMessage());
            }
            throw new StorageDeleteException($error->getMessage());
        }
    }
}
