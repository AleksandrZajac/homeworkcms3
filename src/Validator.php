<?php

// namespace App;

// use Illuminate\Validation;
// use Illuminate\Filesystem;
// use Illuminate\Translation;
// use Illuminate\Validation\DatabasePresenceVerifier;
// use Illuminate\Database\Capsule\Manager as Capsule;
// use App\Config;

// class Validator
// {
//     public $translationDir;
//     public $filesystem;
//     public $fileLoader;
//     public $translator;
//     public $factory;
//     public $dataToValidate;
//     public $validator;
//     public $rules;
//     public $errors;

//     public function __construct($rules)
//     {
//         $this->rules = $rules;
//         $this->errors = $this->validator();
//         $this->fileValidation();
//     }

//     public function fileValidation()
//     {
//         if ($_POST) {
//             echo '<pre>';
//             print_r($_POST);
//             echo '</pre>';
//         }

//         if ($_FILES) {
//             echo '<pre>';
//             print_r($_FILES);
//             echo '</pre>';
//         }
//     }

//     public function errors()
//     {
//         if ($this->errors !== null) {
//             $errors = $this->errors->all();
//             return $errors;
//         }
//     }

//     public function fileLoader()
//     {
//         $this->translationDir = dirname(__DIR__, 1) . '/resource/lang';
//         $this->filesystem = new Filesystem\Filesystem();
//         $this->fileLoader = new Translation\FileLoader($this->filesystem, $this->translationDir);
//         $this->fileLoader->addNamespace('lang', $this->translationDir);
//         $this->fileLoader->load('en', 'validation', 'lang');

//         return $this->fileLoader;
//     }

//     public function translator()
//     {
//         $this->translator = new Translation\Translator($this->fileLoader(), 'en');

//         return $this->translator;
//     }

//     public function factory()
//     {
//         $this->factory = new Validation\Factory($this->translator());

//         return $this->factory;
//     }

//     public function dataToValidate()
//     {
//         foreach ($_POST as $key => $value) {
//             $this->dataToValidate[$key] = trim(htmlspecialchars($value));
//         }

//         return $this->dataToValidate;
//     }

//     public function validator()
//     {
//         $capsule = new Capsule;
//         $config = Config::getInstance();
//         $capsule->addConnection($config->getConfig('db'));
//         $capsule->setAsGlobal();
//         $capsule->bootEloquent();

//         $this->validator = $this->factory()->make($this->dataToValidate(), $this->rules);

//         $verifier = new DatabasePresenceVerifier($capsule->getDatabaseManager());
//         $this->validator->setPresenceVerifier($verifier);

//         if ($this->validator->fails()) {
//             $errors = $this->validator->errors();
//             return $errors;
//         }

//         return null;
//     }
// }
