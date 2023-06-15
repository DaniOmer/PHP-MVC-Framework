


namespace App\controllers;

use App\models\Validation_token;

class Validation_tokenControllers{
    public function create($data, $id){
        $validation_token = new Validation_token(); // Correction du nom de la classe
        $validation_token->setId($id); // Correction du nom de la variable
        $validation_token->setUserid($id); // Correction du nom de la variable
        $validation_token->setToken($data->token);
        $validation_token->setCreatedat($data->created_at);
    }

    public function read(string $id){
        $validation_token = new Validation_token(); // Correction du nom de la classe
        $validation_token->setId($id); // Correction du nom de la variable
    }

    public function update($data){
        $validation_token = new Validation_token(); // Correction du nom de la classe
        $validation_token->setToken($data->token); // Correction du nom de la méthode
    }

    public function delete(string $id){
        $validation_token = new Validation_token(); // Correction du nom de la classe
        $validation_token->setId($id); // Correction du nom de la variable
    }
}
