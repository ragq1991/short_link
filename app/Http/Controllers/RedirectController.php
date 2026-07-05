<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Statistic;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function __invoke(Request $request, string $code)
    {
        $link = Link::where('short_url', $code)->firstOrFail();

        Statistic::create([
            'link_id' => $link->id,
            'client_ip' => $request->ip(),
        ]);

        return redirect()->away($link->origin_url);
    }
}
