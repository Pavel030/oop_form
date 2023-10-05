<?php
namespace App\Model;

use App\modules\model\Model;

class Form extends Model
{
    protected string $tableName = 'form_table';
    public function store($email, $name, $surname, $birthdate, $country, $recognize, $theme, $content, $personal, $filename)
    {
        $connection = $this->database->getConnection();
        $query = "INSERT INTO $this->tableName (email, name, surname, birthdate, country, recognize, theme, content, personal, filename) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ssssssssss", $email, $name, $surname, $birthdate, $country, $recognize, $theme, $content, $personal, $filename);
        $stmt->execute();
    }
}
