<?php

namespace App\services;

use DateTime;

trait ValidationTrait
{
    public function validateEmail($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return 'Некорректное значение для email';
        }
        return null;
    }

    public function validateName($value)
    {
        if (strlen($value) > 200) {
            return "Превышена максимальная длинна";
        }
        if (preg_match('/[0-9$\/:]/', $value)) {
            return "Недопустимо наличие цифр";
        }
        if (!preg_match('/^[\p{L} -]*$/u', $value)) {
            return "Недопустимы специальные знаки";
        }
        return null;
    }

    public function validateDateOfBirth($value)
    {
        if ($value) {
            $currentDate = new DateTime();
            $inputDate = DateTime::createFromFormat('Y-m-d', $value);

            if (!$inputDate || $inputDate > $currentDate) {
                return "Дата выбрана неккорректно";
            }

            $age = $inputDate->diff($currentDate)->y;

            if ($age < 16 || $age > 130) {
                return "Мы принимаем заявки от лиц достигших 16 лет";
            }
            return null;
        }
    }

    public function validateFile($value)
    {
        if ($value['size'] != 0) {
            $fileSizeMB = $value['size'] / (1024 * 1024);
            if ($fileSizeMB > 90) {
                return 'Извините, файл должен быть не более 90 мб';
            }
            $validExtensions = ['pdf', 'docx', 'doc'];
            foreach ($validExtensions as $extension) {
                $regex = '/\.' . $extension . '$/';
                if (preg_match($regex, $value['name'])) {
                    $count[] = 1;
                }
            }
            if (empty($count)){
                return 'Пожалуйста загрузите файл расширения pdf, docx или doc';
            }
        }
        return null;
    }
}