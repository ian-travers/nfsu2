<?php

namespace App\Models\Quiz;

use App\Models\NativeAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Quiz\Answer
 *
 * @property int $id
 * @property int $quiz_question_id
 * @property string $answer_en
 * @property string $answer_ru
 * @property int $index
 * @property-read mixed $answer
 * @property-read \App\Models\Quiz\Question $question
 * @method static \Database\Factories\Quiz\AnswerFactory factory(...$parameters)
 * @method static Builder|Answer newModelQuery()
 * @method static Builder|Answer newQuery()
 * @method static Builder|Answer query()
 * @method static Builder|Answer whereAnswerEn($value)
 * @method static Builder|Answer whereAnswerRu($value)
 * @method static Builder|Answer whereId($value)
 * @method static Builder|Answer whereIndex($value)
 * @method static Builder|Answer whereQuizQuestionId($value)
 * @mixin \Eloquent
 */
class Answer extends Model
{
    use HasFactory, NativeAttribute;

    protected $table = 'quiz_answers';

    public $timestamps = false;

    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo(Question::class, 'quiz_question_id');
    }

    public function getAnswerAttribute()
    {
        return $this->getNativeAttributeValue('answer');
    }
}
