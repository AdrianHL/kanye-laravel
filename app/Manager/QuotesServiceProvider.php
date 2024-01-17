<?php

class QuotesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('quotes', function ($app) {
            return new QuotesManager($app);
        });
    }
}
