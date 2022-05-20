<?php 
use Illuminate\Database\Eloquent\Model as Eloquent;

class Post extends Model{

    protected $fillable = ['categoria_id'];
    protected $guarded = ['categoria_id'];
    
    public function rules(): array{
        return $rules = array(
        'titulo'=>[self::RULE_REQUIRED],
        'contenido'=>[self::RULE_REQUIRED,[self::RULE_MIN, 'min'=>0],[self::RULE_MAX,'max'=>2000]],
        'authors'=>[self::RULE_REQUIRED],
);
        }
        
    public function tableName(): string {
        return 'posts';
    }
    
    public function attributes(): array {
        return ['titulo','contenido','authors'];
    }
    
   //public function files(){
   //    return $this->hasOne('Files');
   //}
    public function coments(){
        return $this->hasMany('Coments');
    }
}
?>