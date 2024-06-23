<?php

namespace App\Http\Controllers;

use App\Models\Client;


class QueryController extends Controller
{
    public function __invoke()
    {
        $data = Client::countOrderPricesLessThan(insertFieldName: 'count1', count: 1000)
            ->countOrderPricesMoreThan(insertFieldName: 'count2', count: 1000)
            ->get();
        return response()->json(data: $data, status: 200);
    }
}
