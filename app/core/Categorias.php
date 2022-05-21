<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Categorias extends Eloquent {

    public function rules(): array{
        return $rules = array(
        'contenido'=>[self::RULE_REQUIRED],
        'id'=>[self::RULE_REQUIRED]
    );
    }
        
    public function tableName(): string {
        return 'categorias';
    }
    
    public function attributes(): array {
        return ['content'];
    }
}