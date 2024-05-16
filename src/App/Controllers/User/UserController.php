<?php

namespace App\Controllers\User;

use System\Controller;
use App\Http\Traits\ResponseHelperTrait;

class UserController extends Controller
{
    use ResponseHelperTrait;
    public function login()
    {

        if (!$this->loginRequest()) {
            $errors = $this->errors;
            return $this->returnWrong('Wrong', $errors);
        }


        $loginModel   = $this->load->model('Login');
        $loggedInUser = $loginModel->user();


        if ($this->request->post('remember')) {
            // save login data in cookie
            $this->cookie->set('login', $loggedInUser->code);
        } else {
            // save login data in session
            $this->session->set('login', $loggedInUser->code);
        }

        $data = $this->userResource($loggedInUser);
        return $this->returnJSON($data, 'Successfully');
    }
    //------------------------------------------------------------------
    ## Validations
    private function loginRequest()
    {
        $email = $this->request->post('email');
        $password = $this->request->post('password');

        if (!$email) {
            $this->errors[] = 'Please Insert Email address';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Please Insert Valid Email';
        }

        if (!$password) {
            $this->errors[] = 'Please Insert Password';
        }

        if (!$this->errors) {
            $loginModel = $this->load->model('Login');

            if (!$loginModel->isValidLogin($email, $password)) {
                $this->errors[] = 'Invalid Login Data';
            }
        }

        return empty($this->errors);
    }
    //------------------------------------------------------------------


    //------------------------------------------------------------------
    ## Resources
    private function userResource($data)
    {
        return [
            'id'    => $data->id,
            'name'  => $data->name,
            'email' => $data->email
        ];
    }


    //------------------------------------------------------------------
}
