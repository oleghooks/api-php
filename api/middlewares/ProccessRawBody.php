<?php

namespace app\middlewares;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class ProccessRawBody implements IMiddleware
{

    /**
     * @inheritDoc
     */
    public function handle(Request $request): void
    {
        $rawBody = $_POST;
        if ($rawBody) {
            try {
             $body = $rawBody;
             foreach ($body as $key => $value) {
                 $request->$key = $value;
             }
            } catch (\Throwable $e) {

            }
        }
    }
}