<?php 
use Illuminate\Database\Eloquent\Model as Eloquent;

class Coment extends Model{

    public function rules(): array{
        return $rules = array(
        'content'=>[self::RULE_REQUIRED]);
    }
        
    public function tableName(): string {
        return 'coments';
    }
    
    public function attributes(): array {
        return ['content'];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
?>