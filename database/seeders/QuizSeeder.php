<?php

namespace Database\Seeders;

use App\Models\Quiz\Question;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run()
    {
        /** @var Question $question */
        $question = Question::create([
            'question_en' => 'What is required in order to take part in the tourney?',
            'question_ru' => 'Что необходимо сделать для того, чтобы принять участие в турнире?',
            'correct_answer' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => 'Fill out "Sign Up" form on this site.',
            'answer_ru' => '"Подать заявку" из меню на этом сайте.',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => 'Send email with request to tourney\'s supervisor.',
            'answer_ru' => 'Отослать письмо с заявкой супервайзеру турнира.',
            'index' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'Ask supervisor to let you take part in this tourney in game chat.',
            'answer_ru' => 'В игровом чате попросить супервайзера разрешить мне участие в турнире.',
            'index' => '3',
        ]);

        // 2
        $question = Question::create([
            'question_en' => 'How often you should sign up for tourneys?',
            'question_ru' => 'Как часто мне нужно подавать заявку на участие в турнирах?',
            'correct_answer' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'Only once. After that I can take part in any future tourney without sign up.',
            'answer_ru' => 'Один раз. В дальнейшем я смогу участвовать в турнирах без подачи заявок.',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => 'I should sign up for each tourney in which I want to take part.',
            'answer_ru' => 'Я должен подавать заявку на каждый турнир, в котором хочу принять участие.',
            'index' => '2',
        ]);

        // 3
        $question = Question::create([
            'question_en' => 'How do I find out who are my opponents?',
            'question_ru' => 'Как мне узнать, кто мои соперники?',
            'correct_answer' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'From game chat.',
            'answer_ru' => 'В игровом чате.',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => 'From tourney table on the site.',
            'answer_ru' => 'В турнирной таблице на этом сайте.',
            'index' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'I should ask supervisor.',
            'answer_ru' => 'Спросить у супервайзера.',
            'index' => '3',
        ]);
        $question->addAnswer([
            'answer_en' => 'I should join to any group I can. If they told me to don\'t join wrong group, then abuse that losers who scared race with me and join to other group.',
            'answer_ru' => 'Зайти в любую группу. Если мне скажут, что я зашел не в ту группу, назвать их сцыкунами, которые боятся со мной проехать, и зайти в какую-нибудь другую группу.',
            'index' => '4',
        ]);

        // 4
        $question = Question::create([
            'question_en' => 'When the sign up period is finished?',
            'question_ru' => 'Когда заканчивается подача заявок на турнир?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer([
            'answer_en' => '5 minutes before the tourney.',
            'answer_ru' => 'За 5 минут до турнира.',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => '30 minutes before the tourney.',
            'answer_ru' => 'За 30 минут до турнира.',
            'index' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'I need to check information about this tourney on the site.',
            'answer_ru' => 'Нужно проверить информацию о турнире на сайте. Там указан период подачи заявок.',
            'index' => '3',
        ]);

        // 5
        $question = Question::create([
            'question_en' => 'When does tourney start?',
            'question_ru' => 'Когда начинается проведение турнира?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer([
            'answer_en' => 'After Tourney table appearance on the site.',
            'answer_ru' => 'Как только на сайте появятся турнирные таблицы.',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => 'After 5 minutes from start time on the site.',
            'answer_ru' => 'Через 5 минут после указанного на сайте времени начала турнира.',
            'index' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'When supervisor tells to start the tourney',
            'answer_ru' => 'Когда супервайзер объявит старт турнира.',
            'index' => '3',
        ]);

        // 6
        $question = Question::create([
            'question_en' => 'If I was disconnected from the game just on 5-th second after the game was started because of my internet provider, what should I do?',
            'question_ru' => 'Я вылетел из гонки на 5-й секунде после старта заезда из-за обрыва связи с интернетом. Что мне делать?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer([
            'answer_en' => 'Ask supervisor to restart this game.',
            'answer_ru' => 'Попросить супервайзера назначить перезаезд это гонки.',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => 'Abuse that bastards who did not stop the game because of my disconnect just on 5-th second, and demand restart from them.',
            'answer_ru' => 'Пожаловаться на участников заезда, что они не остановили заезд, и потребовать рестарта.',
            'index' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'According to the rules this game will not be replayed (who created this damn rule?)',
            'answer_ru' => 'Согласно правил, такой заезд не переигрывается (вот такое дурацкое правило).',
            'index' => '3',
        ]);

        // 7
        $question = Question::create([
            'question_en' => 'If I was assigned to host game, but somebody can not connect to me, what should I do?',
            'question_ru' => 'Я назначен хостом гонки, но один игрок не может присоединиться ко мне. Что я должен делать в таком случае?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer([
            'answer_en' => 'Start game without this unlucky fellow.',
            'answer_ru' => 'Стартовать и ехать до финиша без этого неудачника.',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => 'Keep trying to recreate game again and again during 30 minutes because nobody else allowed to host this game, and after that go without him.',
            'answer_ru' => 'Пересоздавать гонку снова и снова в течение 30 мин, т.к. никто кроме меня не может быть хостом, затем ехать без него.',
            'index' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'Try to change host. After all guys have tried to host and you still can\'t start all together, ask supervisor to help you.',
            'answer_ru' => 'Сменить хост. Если все варианты с хостом опробованы и заезд все еще не состоялся, попросить помощи у супервайзера.',
            'index' => '3',
        ]);

        // 8
        $question = Question::create([
            'question_en' => 'Should I remember places of all guys who race with me?',
            'question_ru' => 'Должен ли я запоминать места всех участников заезда?',
            'correct_answer' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'Am I crazy?!',
            'answer_ru' => 'Что!? Конечно нет!',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => 'Yes.',
            'answer_ru' => 'Да.',
            'index' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'Everybody should remember his own place.',
            'answer_ru' => 'Каждый должен помнить только свое место.',
            'index' => '3',
        ]);

        // 9
        $question = Question::create([
            'question_en' => 'Is 9 TJ\'s upgrades considered as cheat?',
            'question_ru' => '9 TJ уников - это чит?',
            'correct_answer' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'Of course not! Everybody has 9 TJ\'s upgrades.',
            'answer_ru' => 'Нет конечно! Все ездят на 9-ти униках.',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => 'Yes.',
            'answer_ru' => 'Да.',
            'index' => '2',
        ]);

        // 10
        $question = Question::create([
            'question_en' => 'Is such combination of TJ\'s upgrades as Engine, Weight and NOS considered as cheat?',
            'question_ru' => 'Является ли читом комбинация уников Engine, Weight и NOS?',
            'correct_answer' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'No, it is allowed to have not more than any 3 TJ\'s upgrades.',
            'answer_ru' => 'Нет. Эта комбинация правильная, т.к. только в ней 3 уника.',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => 'Yes, this combination is not allowed.',
            'answer_ru' => 'Да. Такая комбинация невозможна и является читом.',
            'index' => '2',
        ]);

        // 11
        $question = Question::create([
            'question_en' => 'When next round will be started?',
            'question_ru' => 'Когда начинаются заезды следующего раунда?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer([
            'answer_en' => 'Right after I have finished one round, I should start play next one to don\'t waste my time.',
            'answer_ru' => 'Сразу после окончания предыдущего раунда. Чего зря время терять!',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => 'When host player asks me to join his game from next round.',
            'answer_ru' => 'Когда хост попросит меня вступить в его игру из следующего раунда.',
            'index' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'When supervisor says to start next round.',
            'answer_ru' => 'Когда супервайзер объявит начало следующего раунда.',
            'index' => '3',
        ]);

        // 12
        $question = Question::create([
            'question_en' => 'In which tourney types the final round played 4 times?',
            'question_ru' => 'Финальный раунд какого типа гонок состоит из 4-х заездов?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer([
            'answer_en' => 'Sprint, Drift.',
            'answer_ru' => 'Спринт, дрифт.',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => 'Circuit.',
            'answer_ru' => 'Кольцо.',
            'index' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'Drag, Sprint.',
            'answer_ru' => 'Дрэг, спринт.',
            'index' => '3',
        ]);
        $question->addAnswer([
            'answer_en' => 'In all 4 types.',
            'answer_ru' => 'Во всех четырех типах.',
            'index' => '4',
        ]);

        // 13
        $question = Question::create([
            'question_en' => 'How many points will be earned for 3-rd place in final game?',
            'question_ru' => 'Сколько очков дается за 3-е место в финальном раунде?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer([
            'answer_en' => '2',
            'answer_ru' => '2',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => '3',
            'answer_ru' => '3',
            'index' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => '4',
            'answer_ru' => '4',
            'index' => '3',
        ]);
        $question->addAnswer([
            'answer_en' => '6',
            'answer_ru' => '6',
            'index' => '4',
        ]);

        // 14
        $question = Question::create([
            'question_en' => 'I was first all the race, but right before finish line some bad guy on purpose crash me into the tree, what should I do?',
            'question_ru' => 'Я шел весь заезд на первом месте, как перед самым финишем, кто-то ударил меня и я угодил в отбойник (стену и т.п.). Что я могу сделать в такой ситуации?',
            'correct_answer' => '3',
        ]);
        $question->addAnswer([
            'answer_en' => 'Demand from supervisor to ban this bastard.',
            'answer_ru' => 'Потребовать супервайзера забанить этого "нехорошего человека".',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => 'Demand restart of this game.',
            'answer_ru' => 'Потребовать рестарта гонки.',
            'index' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => 'Abuse this bastard, all others who don\'t support you and unfair supervisor, but mentally :) - according to goddamn rules this game will not be restarted.',
            'answer_ru' => 'Послать эту сволочь, заодно всех участников заезда и супервайзера в придачу. Послать, но только мысленно :). А если серьезно, то по правилам, такой заезд не переигрывается.',
            'index' => '3',
        ]);

        // 15
        $question = Question::create([
            'question_en' => 'How many laps in a regular round of the Drift or Circuit tourney?',
            'question_ru' => 'Из скольки кругов состоит обычный раунд турнира по Дрифту или Кольцу?',
            'correct_answer' => '4',
        ]);
        $question->addAnswer([
            'answer_en' => '2',
            'answer_ru' => '2',
            'index' => '1',
        ]);
        $question->addAnswer([
            'answer_en' => '3',
            'answer_ru' => '3',
            'index' => '2',
        ]);
        $question->addAnswer([
            'answer_en' => '5',
            'answer_ru' => '5',
            'index' => '3',
        ]);
        $question->addAnswer([
            'answer_en' => '6',
            'answer_ru' => '6',
            'index' => '4',
        ]);
        $question->addAnswer([
            'answer_en' => '10',
            'answer_ru' => '10',
            'index' => '5',
        ]);
    }
}
