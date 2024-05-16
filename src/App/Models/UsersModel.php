<?php

namespace App\Models;

use System\Model;

class UsersModel extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Get All Users
     *
     * @return array
     */
    public function all()
    {
        return $this->select('*')->from('users')->fetchAll();
    }

    /**
     * Create New User
     *
     * @return void
     */
    public function create()
    {
        $image = $this->uploadImage();

        if ($image) {
            $this->data('image', $image);
        }

        $this->data('name', $this->request->post('name'))
            ->data('email', $this->request->post('email'))
            ->data('password', password_hash($this->request->post('password'), PASSWORD_DEFAULT))
            ->data('status', $this->request->post('status'))
            ->data('gender', $this->request->post('gender'))
            ->data('birthday', strtotime($this->request->post('birthday')))
            ->data('ip', $this->request->server('REMOTE_ADDR'))
            ->data('created_at', $now = date('Y-m-d H:i:s'))
            ->data('code', sha1($now . mt_rand()))
            ->insert('users');
    }

    /**
     * Upload User Image
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

    /**
     * Update Users Record By Id
     *
     * @param int $id
     * @param int $usersGroupId
     * @return void
     */
    public function update($id, $usersGroupId = null)
    {
        $image = $this->uploadImage();

        if ($image) {
            $this->data('image', $image);
        }

        $password = $this->request->post('password');

        if ($password) {
            $this->data('password', password_hash($password, PASSWORD_DEFAULT));
        }

        $this->data('name', $this->request->post('name'))
            ->data('email', $this->request->post('email'))
            ->data('status', $this->request->post('status'))
            ->data('gender', $this->request->post('gender'))
            ->data('birthday', strtotime($this->request->post('birthday')))
            ->data('updated_at', $now = date('Y-m-d H:i:s'))
            ->where('id=?', $id)
            ->update('users');
    }
}
