<?php

namespace App\Requests;

// use App\Models\Article;

class ArticleRequest
{
    protected $validate = [];
    protected $errors = [];
    protected $rules = [];

    public function validate()
    {
        foreach ($_POST as $key => $value) {
            $this->validate[$key] = trim(htmlspecialchars($value));
        }

        return $this->validate;
    }

    public function rules()
    {
        return [
            'slug' => 'required|unique:article',
            'title'  => 'required',
            'image' => 'required',
            'description' => 'required',
        ];
    }

    public function convertRules()
    {
        foreach ($this->rules() as $key1 => $value) {
            $arr = explode("|", $value);
            foreach ($arr as $key2 => $val) {
                $this->rules[][$key1] = explode(":", $val);
            }
        }

        return $this->rules;
    }

    public function message()
    {
        return [
            'required'  => 'Это поле обязательно',
            'unique:attribute' => 'Поле :attribute должно быть уникально',
        ];
    }

    public function errorMessage($validationField, $ruleMessage)
    {
        $arr = explode(" ", $ruleMessage);
        $attributeKey = array_search(':attribute', $arr);
        $arr[$attributeKey] = $validationField;
        $errorMessage = implode(" ", $arr);

        return $errorMessage;
    }

    public function service()
    {
        // $this->errors[] = $this->convertRules();
        foreach ($this->convertRules() as $convertRules) {
            foreach ($convertRules as $validationField => $validationRule) {
                foreach ($this->validate() as $validationKey => $validationValue) {
                    if ($validationField == $validationKey && $validationValue == null && !in_array('поле' . ' ' . $validationField . ' ' . $this->message()['required'], $this->errors)) {

                        $this->errors[] = 'поле' . ' ' . $validationField . ' ' . $this->message()['required'];
                    }

                    // $arr = explode(" ", $this->message()['unique:attribute']);
                    // $var = array_search(':attribute', $arr);
                    // $arr[1] = 'validationField';
                    // $str = implode(" ", $arr);

                    // $this->errors[] = $str;

                    if ($validationField == $validationKey && $validationValue !== null && $validationRule[0] == 'unique') {

                        $class = '\\App\\Models\\' . ucfirst($validationRule[1]);
                        $article = false;

                        if (class_exists($class)) {
                            $article = $class::where($validationKey, $validationValue)->first();
                        }
                        if ($article) {
                            // $this->errors[] = 'поле' . ' ' . $validationField . ' ' . $this->message()['unique:attribute'];
                            $this->errors[] = $this->errorMessage($validationField, $this->message()['unique:attribute']);
                        }
                    }
                }
            }
        }

        if (count($this->errors) !== 0) {
            return $this->errors;
        }

        return 'success';
    }
}
