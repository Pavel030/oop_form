<?php

namespace App\Http\Controllers;

use App\Model\Form;
use App\modules\route\Route;
use App\modules\view\View;
use App\services\HashTrait;
use App\services\Mail;
use App\services\ValidationTrait;

class FormController extends Controller
{
    use ValidationTrait;
    use HashTrait;

    public function index()
    {
        session_start();
        if (!empty($_SESSION['form_errors'])) {
            $errors = $_SESSION['form_errors'];
            $input = $_SESSION['input'];
            unset($_SESSION['form_errors']);
            unset($_SESSION['input']);
        } else {
            $errors = [];
            $input = [];
        }
        return View::view('form', compact('errors', 'input'));
    }

    public function show($page = 1)
    {
        $request = new Form();
        $limit = 4;
        $offset = $limit * ($page - 1);
        $amountMessages = $request->amount();
        $pages = ceil($amountMessages / $limit);
        $paginatedMessages = $request->paginate($limit, $offset);
        return View::view('table', compact('page', 'pages', 'paginatedMessages'));
    }

    public function store()
    {
        $errors = [];
        $input['email'] = $_POST['email'];
        if ($this->validateEmail($input['email'])) {
            $errors['email'] = $this->validateEmail($input['email']);
        }
        $input['name'] = $_POST['name'];
        if ($this->validateName($input['name'])) {
            $errors['name'] = $this->validateName($input['name']);
        }
        $input['surname'] = $_POST['surname'];
        if ($this->validateName($input['surname'])) {
            $errors['surname'] = $this->validateName($input['surname']);
        }
        $input['country'] = $_POST['country'];
        $input['birthdate'] = $_POST['birthdate'];
        if ($this->validateDateOfBirth($input['birthdate'])) {
            $errors['birthdate'] = $this->validateDateOfBirth($input['birthdate']);
        }
        $input['birthdate'] = $input['birthdate'] ?: null;
        $recognize = isset($_POST['recognize']) ? $_POST['recognize'] : [];
        $input['recognize'] = implode(', ', $recognize);

        $input['theme'] = $_POST['theme'];

        $input['content'] = $_POST['content'];
        $input['personal'] = ($_POST['personal']) == 'on' ? 'согласен' : 'не согласен';
        if($this->validateFile($_FILES['userFile'])) {
            $errors['fileError'] = $this->validateFile($_FILES['userFile']);
        }
        $tmpName = $_FILES['userFile']['tmp_name'];
        $input['filename'] = $this->hash($_FILES['userFile']['name']);
        $targetDirectory = 'uploads/';
        $targetFile = $targetDirectory . basename($input['filename']);
        if (!empty($errors)) {
            session_start();
            $_SESSION['form_errors'] = $errors;
            $_SESSION['input'] = $input;
            return Route::redirect('form');
        } else {
            var_dump($tmpName);
            move_uploaded_file($tmpName, $targetFile);
            $request = new Form();
            $request->store(...$input);
            $mail = new Mail();
            $mail = $mail->send($input['theme'], $input['name'], $input['surname']);
            return Route::redirect('show/');
        }
    }
}// ДОБАВИТЬ В ГИТ ИГНОР ЗАГРУЗКИ И АЙДЕА