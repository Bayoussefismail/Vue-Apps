<?php

namespace App;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Question extends Model
{
  protected $fillable = ['title', 'body', 'slug'];
    public function user() {
      return $this->belongsTo(User::class);
    }
    public function setTitleAttribute($value) {
      $this->attributes['title'] = $value;
      $this->attributes['slug'] = Str::slug($value);
    }

    public function getUrlAttribute(){
      return route('questions.show', $this->id);
    }
    public function getCreatedDate() {
      return $this->created_at->diffForHumans();
    }
}
