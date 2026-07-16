<?php

namespace App\Providers;

use App\Core\Domain\Repositories\User\UserQueryRepository;
use App\Core\Domain\Repositories\User\UserRepository;
use App\Core\Ports\Auth\TokenGeneratorPort;
use App\Core\Ports\Auth\TokenRevokerPort;
use App\Core\Ports\Shared\MailPort;
use App\Core\Ports\Shared\PasswordHasherPort;
use App\Core\Ports\Shared\SlugGeneratorPort;
use App\Core\Ports\Storage\StoragePort;
use App\Infrastructure\Adapters\Auth\SanctumTokenGeneratorAdapter;
use App\Infrastructure\Adapters\Auth\SanctumTokenRevokerAdapter;
use App\Infrastructure\Adapters\Database\Repositories\User\UserQueryRepositoryImpl;
use App\Infrastructure\Adapters\Database\Repositories\User\UserRepositoryImpl;
use App\Infrastructure\Adapters\Shared\MailAdapter;
use App\Infrastructure\Adapters\Shared\PasswordHasherAdapter;
use App\Infrastructure\Adapters\Shared\SlugGeneratorAdapter;
use App\Infrastructure\Adapters\Storage\S3StorageAdapter;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
        $this->app->bind(UserQueryRepository::class, UserQueryRepositoryImpl::class);

        $this->app->bind(MailPort::class, MailAdapter::class);
        $this->app->bind(StoragePort::class, S3StorageAdapter::class);
        $this->app->bind(SlugGeneratorPort::class, SlugGeneratorAdapter::class);
        $this->app->bind(PasswordHasherPort::class, PasswordHasherAdapter::class);
        $this->app->bind(TokenGeneratorPort::class, SanctumTokenGeneratorAdapter::class);
        $this->app->bind(TokenRevokerPort::class, SanctumTokenRevokerAdapter::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale("ru_RU");

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
