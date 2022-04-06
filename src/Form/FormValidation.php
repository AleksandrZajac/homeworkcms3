<?php

namespace App\Form;

use Illuminate\Validation;
use Illuminate\Filesystem;
use Illuminate\Translation;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Validation\DatabasePresenceVerifier;
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Config;
use App\Form\FileValidation;

class FormValidation
{
    protected $translationDir;
    protected $filesystem;
    protected $fileLoader;
    protected $translator;
    protected $factory;
    protected $dataToValidate;
    protected $validator;
    protected $rules;
    protected $errors;

    public function __construct($rules)
    {
        $this->rules = $rules;
        $this->errors = $this->formValidation();
    }

    public function errors()
    {
        if ($this->errors !== null) {
            $errors = $this->errors->all();
            return $errors;
        }
    }

    public function fileLoader()
    {
        $this->translationDir = $_SERVER['DOCUMENT_ROOT'] . '/resource/lang';
        $this->filesystem = new Filesystem\Filesystem();
        $this->fileLoader = new Translation\FileLoader($this->filesystem, $this->translationDir);
        $this->fileLoader->addNamespace('lang', $this->translationDir);
        $this->fileLoader->load('en', 'validation', 'lang');

        return $this->fileLoader;
    }

    public function translator()
    {
        $this->translator = new Translation\Translator($this->fileLoader(), 'en');

        return $this->translator;
    }

    public function factory()
    {
        $this->factory = new Validation\Factory($this->translator());

        return $this->factory;
    }

    public function dataToValidate()
    {
        // foreach ($_POST as $key => $value) {
        //     $this->dataToValidate[$key] = trim(htmlspecialchars($value));
        // }

        // foreach ($_FILES as $key => $value) {
        //     $this->dataToValidate[$key] = $value['type'];
        // }
        // $this->dataToValidate = Request::createFromGlobals();
        $validation = new FileValidation();
        $this->dataToValidate = $validation->fileValidation();

        echo '<pre>';
        print_r($this->dataToValidate);
        echo '</pre>';
        // exit();

        return $this->dataToValidate;
    }

    public function formValidation()
    {
        $capsule = new Capsule;
        $config = Config::getInstance();
        $capsule->addConnection($config->getConfig('db'));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $this->validator = $this->factory()->make($this->dataToValidate(), $this->rules);

        $verifier = new DatabasePresenceVerifier($capsule->getDatabaseManager());
        $this->validator->setPresenceVerifier($verifier);

        if ($this->validator->fails()) {
            $errors = $this->validator->errors();
            return $errors;
        }

        return null;
    }
}
