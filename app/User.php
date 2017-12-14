<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function publish(Quiz $quiz)
    {
        return $this->quizzes()->save($quiz);
    }

    public function saveScore(Score $score)
    {
        return $this->scores()->save($score);
    }

}
