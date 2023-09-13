<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Handlers\COMPANYApiHandler;
use Illuminate\Http\Client\Response;

class COMPANYApiModel extends Model
{
    use HasFactory;

    const GET_POSTS_ENDPOINT = 'GetTransferListModifiedByClient';

    public function getPosts($dateFrom)
    {
        $COMPANYApiHandler = new COMPANYApiHandler();
        $endpoint = $this->getPostsEndpoint();
        $params = $this->getPostsParams($dateFrom);

        $allResults = [];

        $page = 0;

        do {
            $page++;
            $params['page'] = $page;
            $response = $COMPANYApiHandler->sendGetRequest($endpoint, $params);
            $results = $response['clips'];
        
            $allResults = array_merge($allResults, $results);
        } while ($page !== $response['totalPages']);

        return $allResults;
    }

    private function getPostsEndpoint() : string
    {
        return 'api/v' . env('COMPANY_API_VERSION') . '/Clips/' . COMPANYApiModel::GET_POSTS_ENDPOINT;
    }

    private function getPostsParams($dateFrom) : array
    {
        return [
            "dateFrom" => $dateFrom,
            "clientID" => env('COMPANY_API_CLIENT_ID'),
            "pageSize" => 100,
            "page" => 1,
        ];
    }
}