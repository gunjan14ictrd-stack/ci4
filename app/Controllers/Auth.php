<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerSave()
    {
        helper(['form', 'url']);

        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'number' => 'required|min_length[10]|numeric',
            'password' => 'required|min_length[8]',
            'confirm_password' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return view('auth/register', ['validation' => $this->validator]);
        }

        // Hash the password
        $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);

        $userModel = new UserModel();
        $userModel->save([
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'number' => $this->request->getVar('number'),
            'password' => $password
        ]);

        // Set success message and redirect to login
        session()->setFlashdata('success', 'Registration successful! Please login.');
        return redirect()->to('/login');
    }

    public function createPasswordForm($id)
    {
        return view('auth/create-password', ['id' => $id]);
    }

    public function createPasswordSave($id)
    {
        helper(['form']);

        $rules = [
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|regex_match[/^[a-z0-9]+$/]',
                'errors' => [
                    'regex_match' => 'Password must contain only lowercase letters and numbers.'
                ]
            ],
            'conf_password' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return view('auth/create-password', ['validation' => $this->validator, 'id' => $id]);
        }

        $userModel = new UserModel();
        $userModel->update($id, [
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/login')->with('success', 'Password created! You may now login.');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginCheck()
    {
        $userModel = new UserModel();

        $user = $userModel->where('email', $this->request->getVar('email'))->first();

        if (!$user || !password_verify($this->request->getVar('password'), $user['password'])) {
            return redirect()->back()->with('error', 'Invalid Email or Password');
        }

        session()->set([
            'user_id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'logged_in' => true
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
