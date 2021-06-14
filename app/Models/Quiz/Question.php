<?php

namespace App\Models\Quiz;

use App\Models\NativeAttribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Quiz\Question
 *
 * @property int $id
 * @property string $question_en
 * @property string $question_ru
 * @property int $correct_answer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Quiz\Answer[] $answers
 * @property-read int|null $answers_count
 * @method static Builder|Question newModelQuery()
 * @method static Builder|Question newQuery()
 * @method static Builder|Question query()
 * @method static Builder|Question whereCorrectAnswer($value)
 * @method static Builder|Question whereId($value)
 * @method static Builder|Question whereQuestionEn($value)
 * @method static Builder|Question whereQuestionRu($value)
 * @mixin \Eloquent
 */
class Question extends Model
{
    use HasFactory, NativeAttribute;

    protected $table = 'quiz_questions';

    public $timestamps = false;

    protected $guarded = [];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'quiz_question_id');
    }

    public function addAnswer(array $attributes): void
    {
        $this->answers()->create($attributes);
    }

    public function getQuestionAttribute()
    {
        return $this->getNativeAttributeValue('question');
    }
}
