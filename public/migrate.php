<?php
define('LARAVEL_START', microtime(true));

// Normalize SCRIPT_NAME to prevent path issues
if (isset($_SERVER['SCRIPT_NAME']) && str_contains($_SERVER['SCRIPT_NAME'], '/public/migrate.php')) {
    $_SERVER['SCRIPT_NAME'] = str_replace('/public/migrate.php', '/migrate.php', $_SERVER['SCRIPT_NAME']);
    $_SERVER['PHP_SELF'] = str_replace('/public/migrate.php', '/migrate.php', $_SERVER['PHP_SELF']);
}

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

use Illuminate\Support\Facades\Artisan;

// We need to bootstrap the kernel to get facades working properly
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

echo "<html><body style='font-family: sans-serif; padding: 2rem;'>";
try {
    echo "<h1>Database Migration Tool</h1>";
    echo "<p>Running migrations... please wait.</p>";
    
    // Run migrations
    $exitCode = Artisan::call('migrate', ['--force' => true]);
    
    echo "<h3>Result:</h3>";
    echo "<pre style='background: #f4f4f4; padding: 1rem; border-radius: 5px;'>" . Artisan::output() . "</pre>";
    
    if ($exitCode === 0) {
        echo "<h2 style='color:green'>✅ Migration successful!</h2>";
        echo "<p>Your database is now up to date. You can close this page and try uploading your video again.</p>";
        echo "<a href='./login' style='display: inline-block; padding: 10px 20px; background: #556b2f; color: white; text-decoration: none; border-radius: 5px;'>Go to Dashboard</a>";
    } else {
        echo "<h2 style='color:red'>❌ Migration failed with exit code: $exitCode</h2>";
    }
} catch (\Exception $e) {
    echo "<h2 style='color:red'>❌ Error:</h2>";
    echo "<pre style='color: red;'>" . $e->getMessage() . "</pre>";
}
echo "</body></html>";
