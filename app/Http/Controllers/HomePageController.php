<?php

namespace App\Http\Controllers;

use App\Models\PostsModel;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class HomePageController extends Controller
{
    /**
     * Display the home page.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $postsModel = new PostsModel();
        $articlesPerPage = 10;
        $allPosts = $postsModel->getPostsFromDatabse();

        $currentPage = $request->query('page', 1);
        $pagedData = $allPosts->slice(($currentPage - 1) * $articlesPerPage, $articlesPerPage);
        $posts = new LengthAwarePaginator($pagedData->all(), $allPosts->count(), $articlesPerPage, $currentPage);

        $dateTime = new DateTime();
        $currentDateTime = $dateTime->format('Y-m-d H:i:s');

        return view('home', ['posts' => $posts]);
    }
}
