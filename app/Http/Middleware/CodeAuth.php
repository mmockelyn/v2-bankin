<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\Request;

class CodeAuth
{
    /**
     * @var ResponseFactory
     */
    protected $responseFactory;
    /**
     * @var UrlGenerator
     */
    protected $urlGenerator;
    /**
     * @var null
     */
    private $passwordTimeout;

    /**
     * CodeAuth constructor.
     * @param ResponseFactory $responseFactory
     * @param UrlGenerator $urlGenerator
     * @param null $passwordTimeout
     */
    public function __construct(ResponseFactory $responseFactory, UrlGenerator $urlGenerator, $passwordTimeout = null)
    {
        $this->responseFactory = $responseFactory;
        $this->urlGenerator = $urlGenerator;
        $this->passwordTimeout = $passwordTimeout ?: 10800;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $passwordTimeoutSeconds = null)
    {
        if($this->shouldConfirmCode($request, $passwordTimeoutSeconds)) {
            return $this->responseFactory->redirectTo($this->urlGenerator->route('auth.code', ["uri_previous" => \Route::currentRouteName()]));
        }
        return $next($request);
    }

    protected function shouldConfirmCode($request, $passwordTimeoutSeconds = null)
    {
        $confirmedAt = time() - $request->session()->get('auth.authCode_confirmed_at', 0);

        return $confirmedAt > ($passwordTimeoutSeconds ?? $this->passwordTimeout);
    }
}
