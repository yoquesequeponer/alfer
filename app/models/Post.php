<?php 
use Illuminate\Database\Eloquent\Model as Eloquent;

class Post extends Model{

    protected $fillable = ['titulo','contenido', 'categoria_id'];
    protected $guarded = [''];
    
    public function rules(): array{
        return $rules = array(
        'titulo'=>[self::RULE_REQUIRED],
        'contenido'=>[self::RULE_REQUIRED],
        'titulo'=>[self::RULE_REQUIRED],
        'categoria_id'=>[self::RULE_REQUIRED],

);
        }
        
    public function tableName(): string {
        return 'posts';
    }
    
    public function attributes(): array {
        return ['titulo','contenido'];
    }
    
   public function files(){
       return $this->hasOne('Files');
   }
    public function coments(){
        return $this->hasMany(Coment::class);
    }
    public function filter(){
        return $this->hasOne(Categorias::class);
    }
    public function user(){
        return $this->hasOne(User::class);
    }
}
?>