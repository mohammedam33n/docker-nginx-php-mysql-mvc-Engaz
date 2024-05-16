<?php

namespace App\Controllers\User;

use System\Controller;
use App\Http\Traits\ResponseHelperTrait;

class ArticlesController extends Controller
{
    use ResponseHelperTrait;


    public function index()
    {

        if (!checkAuth()) {
            return $this->returnWrong('Unauthenticated', 401);
        }

        $data     = $this->load->model('Articles')->all();
        $articles = $this->articleCollection($data);
        $data = [
            'articles' => $articles,
        ];
        return $this->returnJSON($data, 'Successfully');
    }
    public function store()
    {
        if (!checkAuth()) {
            return $this->returnWrong('Unauthenticated', 401);
        }

        if (!$this->articleStoreRequest()) {
            $errors = $this->validator->flattenMessages();
            return $this->returnWrong('Wrong', $errors);
        }

        $this->load->model('Articles')->create();
        return $this->returnSuccess('Article Has Been Created Successfully');
    }
    public function show($id)
    {
        if (!checkAuth()) {
            return $this->returnWrong('Unauthenticated', 401);
        }

        $article = $this->load->model('Articles');
        if (!$article->exists($id)) {
            return $this->returnWrong('Not Found');
        }

        $data = $article->get($id);
        $data = $this->articleResource($data);

        return $this->returnJSON($data, 'Successfully');
    }
    public function update($id)
    {
        if (!checkAuth()) {
            return $this->returnWrong('Unauthenticated', 401);
        }
        if (!$this->articleStoreRequest()) {
            $errors = $this->validator->flattenMessages();
            return $this->returnWrong('Wrong', $errors);
        }

        $article = $this->load->model('Articles');
        if (!$article->exists($id)) {
            return $this->returnWrong('Not Found');
        }

        $this->load->model('Articles')->update($id);
        return $this->returnSuccess('Article Has Been Updated Successfully');
    }
    public function delete($id)
    {
        if (!checkAuth()) {
            return $this->returnWrong('Unauthenticated', 401);
        }

        $articleModel = $this->load->model('Articles');

        if (!$articleModel->exists($id)) {
            return $this->returnWrong('Not Found');
        }

        $articleModel->delete($id);
        // $articleModel->softDelete($id);
        return $this->returnSuccess('Article Has Been Deleted Successfully');
    }
    //------------------------------------------------------------------


    //------------------------------------------------------------------
    ## Validations
    private function articleStoreRequest()
    {
        $this->validator->required('title', 'Article Title is Required');
        $this->validator->required('des', 'Article Des is Required');
        return $this->validator->passes();
    }

    private function articleUpdateRequest()
    {
        $this->validator->required('title', 'Article Title is Required');
        $this->validator->required('des', 'Article Des is Required');
        return $this->validator->passes();
    }
    //------------------------------------------------------------------


    //------------------------------------------------------------------
    ## Resources
    private function articleResource($data)
    {
        return [
            'id'    => $data->id,
            'title' => $data->title,
            'des'   => $data->des
        ];
    }

    private function articleCollection($data)
    {

        $filteredData = [];
        foreach ($data as $item) {
            $filteredData[] = [
                'id'    => $item->id,
                'title' => $item->title,
                'des'   => $item->des,
            ];
        }

        return $filteredData;
    }
    //------------------------------------------------------------------
}
