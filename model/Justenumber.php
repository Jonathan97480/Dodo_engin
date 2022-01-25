<?php
class Justenumber extends Model
{

    public $table = 't_number';


    public function register(string $name, int $age, int $score, int $error, string $avatar, $dif): stdClass
    {

        $user = new stdClass();
        $user->info = new stdClass();

        /*  if (isVarsEmpty([$name, $age, $score, $error, $avatar])) {
            return error_log("Les donées ne sont pas complete");
        } */

        $user->info->name = $name;
        $user->info->age = $age;
        $user->info->dif = $dif;
        $user->info->score = $score;
        $user->info->error = $error;
        $user->info->avatar = $avatar;

        $this->save($user->info);

        return $user->info;
    }

    function getAllPlayer(): array
    {

        $allPlayer = new stdClass();

        $allPlayer->info = $this->find([]);

        return $allPlayer->info;
    }
}
