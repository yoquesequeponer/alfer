<?php 
use Illuminate\Database\Eloquent\Model as Eloquent;

class Valoration extends Model{

   //public function rules(): array{
   //    return $rules = array(
   //    'content'=>[self::RULE_REQUIRED],
   //    'user_id'=>[self::RULE_REQUIRED]
   //
   //
   //
   //);
   //}
        
    public function tableName(): string {
        return 'valoraciones';
    }
    
    public function attributes(): array {
        return ['content'];
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

}
?>