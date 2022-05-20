<?php 

class User extends Model{


protected $fillable = ['userName', 'correo', 'password','nombre'];
protected $guarded = ['id'];

public function rules(): array{
    return $rules = array(
        'userName'=> [self::RULE_REQUIRED],
        'correo'=> [self:: RULE_REQUIRED, self:: RULE_EMAIL],
        'password'=> [self:: RULE_REQUIRED],
        'confirmpassword'=>[self::RULE_REQUIRED, [self:: RULE_MATCH, 'match '=>'password']]);
        
}

public function tableName(): string{
    return 'users';
}

public function attributes(): array{
    return ['userName','nombre', 'correo', 'password', 'nombreUsuario', 'apellido', 'rol' ];
}
public function coments(){
    return $this->hasMany(Coment::class);
}

}
?>