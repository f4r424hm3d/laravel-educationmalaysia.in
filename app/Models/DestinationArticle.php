<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationArticle extends Model
{
  use HasFactory;
  public function getUser()
  {
    return $this->hasOne(User::class, 'id', 'author_id');
  }
  public function getDestination()
  {
    return $this->hasOne(Destination::class, 'id', 'destination_id');
  }
  public function getAllContent()
  {
    return $this->hasMany(DestinationArticleContents::class, 'article_id', 'id');
  }
  public function getAllMasterContent()
  {
    return $this->hasMany(DestinationArticleContents::class, 'article_id', 'id')->where('parent_id', null);
  }
  public function faqs()
  {
    return $this->hasMany(DestinationArticleFaq::class, 'destination_article_id', 'id');
  }
}
