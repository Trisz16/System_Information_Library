<?php

namespace Illuminate\Foundation\Testing;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use Concerns\InteractsWithContainer,
        Concerns\MakesHttpRequests,
        Concerns\InteractsWithAuthentication,
        Concerns\InteractsWithConsole,
        Concerns\InteractsWithDatabase,
        Concerns\InteractsWithDeprecationHandling,
        Concerns\InteractsWithExceptionHandling,
        Concerns\InteractsWithSession,
        Concerns\InteractsWithTime,
        Concerns\InteractsWithTestCaseLifecycle,
        Concerns\InteractsWithViews;

    /**
<<<<<<< HEAD
     * The list of trait that this test uses, fetched recursively.
     *
     * @var array<class-string, int>
     */
    protected array $traitsUsedByTest;

    /**
=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require Application::inferBasePath().'/bootstrap/app.php';

<<<<<<< HEAD
        $this->traitsUsedByTest = array_flip(class_uses_recursive(static::class));

        if (isset(CachedState::$cachedConfig) &&
            isset($this->traitsUsedByTest[WithCachedConfig::class])) {
            $this->markConfigCached($app);
        }

        if (isset(CachedState::$cachedRoutes) &&
            isset($this->traitsUsedByTest[WithCachedRoutes::class])) {
            $app->booting(fn () => $this->markRoutesCached($app));
        }

=======
>>>>>>> 049e9c5cd56276e2255d7f3c44e689248e341a1e
        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->setUpTheTestEnvironment();
    }

    /**
     * Refresh the application instance.
     *
     * @return void
     */
    protected function refreshApplication()
    {
        $this->app = $this->createApplication();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     *
     * @throws \Mockery\Exception\InvalidCountException
     */
    protected function tearDown(): void
    {
        $this->tearDownTheTestEnvironment();
    }

    /**
     * Clean up the testing environment before the next test case.
     *
     * @return void
     */
    public static function tearDownAfterClass(): void
    {
        static::tearDownAfterClassUsingTestCase();
    }
}
