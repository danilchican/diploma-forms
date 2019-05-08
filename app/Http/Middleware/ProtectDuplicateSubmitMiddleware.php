<?php

namespace App\Http\Middleware;

use App\Models\SubmittedForm;
use Closure;

class ProtectDuplicateSubmitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->filled('form-id')) {
            $submittedForm = SubmittedForm::submittedBy($request->ip())
                ->forForm($request->input('form-id'))
                ->first();

            if ($submittedForm !== null) {
                abort(403);
            }
        }

        return $next($request);
    }
}
