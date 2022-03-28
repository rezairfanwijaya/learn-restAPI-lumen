<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    //  method ini berfungsi untuk menghandle semua request yang masuk ke dalam aplikasi
    // lebih detail nya function handle ini akan mengecek user ketika user mengakses api produk yang ada pada ProdukController.php
    // jika user tidak memiliki token maka akan muncul error yang mengandung pesan "Unauthenticated."
    // agar bisa berfungsi kita harus membuat constructor pada produk controller yang mengandung middleware Authenticate.php
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            return response('Masukan token terlebih dahulu.', 401);
        }

        return $next($request);
    }
}
