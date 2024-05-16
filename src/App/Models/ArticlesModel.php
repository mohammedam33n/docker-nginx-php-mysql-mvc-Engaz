<?php

namespace App\Models;

use System\Model;

class ArticlesModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * Create New Category Record
     *
     * @return void
     */
    public function create()
    {


        $image = $this->uploadImage();

        if ($image) {
            $this->data('image', $image);
        }

        $this->data('title', $this->request->post('title'))
            ->data('des', $this->request->post('des'))
            ->data('status', $this->request->post('status'))
            ->data('created_at', $now = date('Y-m-d H:i:s'))
            ->insert($this->table);
    }

    /**
     * Update Category Record By Id
     *
     * @param int $id
     * @return void
     */
    public function update($id)
    {
        $image = $this->uploadImage();

        if ($image) {
            $this->data('image', $image);
        }

        $this->data('title', $this->request->post('title'))
            ->data('des', $this->request->post('des'))
            ->data('status', $this->request->post('status'))
            ->data('updated_at', $now = date('Y-m-d H:i:s'))
            ->where('id=?', $id)
            ->update($this->table);
    }



    /**
     * Upload Post Image
     *
     * @return string
     */
    private function uploadImage()
    {
        $image = $this->request->file('image');

        if (!$image->exists()) {
            return '';
        }

        return $image->moveTo($this->app->file->toPublic('images'));
    }
}
