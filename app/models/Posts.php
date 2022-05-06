<?php 
use Illuminate\Database\Eloquent\Model as Eloquent;

class Posts extends Model{

    public function rules(): array{
        return $rules = array(
        'titulo'=>[self::RULE_REQUIRED],
        'contenido'=>[self::RULE_REQUIRED,[self::RULE_MIN, 'min'=>0],[self::RULE_MAX,'max'=>2000]],
        'authors'=>[self::RULE_REQUIRED],
);
        }
        
    public function tableName(): string {
        return 'Posts';
    }
    
    public function attributes(): array {
        return ['titulo','contenido','authors'];
    }
    
    public function files(){
        return $this->hasOne('Files');
    }
}
?>