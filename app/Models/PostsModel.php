<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\COMPANYApiModel;
use Carbon\Carbon;

class PostsModel extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'clip_id',
        'clip_published',
        'clip_title',
        'clip_authors',
        'clip_url',
        'clip_subtitle',
        'clip_content',
        'created_at',
        'updated_at',
    ];

    public function getPostsFromDatabse()
    {
        return $this->all();
    }

    public function saveOrUpdate($dateFrom)
    {
        $COMPANYApiModel = new COMPANYApiModel();
        $posts = $COMPANYApiModel->getPosts($dateFrom);

        foreach ($posts as $post) {
            if (
                isset($post['clip_published']) && !empty($post['clip_published']) &&
                isset($post['clip_title']) && !empty($post['clip_title']) &&
                isset($post['clip_url']) && !empty($post['clip_url']) &&
                isset($post['clip_content']) && !empty($post['clip_content'])
            ) {
                self::updateOrCreate(
                    [
                        'clip_id' => $post['clip_id'],
                    ],
                    [
                        'clip_published' => Carbon::parse($post['clip_published']),
                        'clip_title' => $post['clip_title'],
                        'clip_authors' => isset($post['clip_authors']) ? json_encode($post['clip_authors']) : null,
                        'clip_url' => $post['clip_url'],
                        'clip_subtitle' => $post['clip_subtitle'],
                        'clip_content' => $post['clip_content'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]
                );
            }
        }
    }
}