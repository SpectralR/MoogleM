<?php

namespace App\Http\Controllers;

use App\User;
use App\Topic;
use App\Message;
use App\Category;
use App\Forms\TopicForm;
use App\Forms\MessageForm;
use Illuminate\Http\Request;
use App\Notifications\ForumNewMsg;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Repositories\MessageRepoInterface;
use Illuminate\Support\Facades\Notification;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class ForumController extends Controller
{
    protected $category;
    protected $topic;
    protected $message;


    public function index()
    {
        $cats = Category::get();
        return view('forum/index', ['categories' =>$cats]);
    }

    public function showCat($cat)
    {
        $forumCategory = Category::find($cat);
        $catTopics = Topic::where('category_id', '=', $cat)->get();

        return view('forum/category', [
            'cat' => $forumCategory,
            'topics' => $catTopics
        ]);
    }

    use FormBuilderTrait;
    public function showMessages(FormBuilder $formBuilder, $topic)
    {
        $messages = Message::where('topic_id', '=', $topic)->get();

        $form = $this->form(MessageForm::class,[
            'method' =>'POST',
            'url' => route('write_message', [
                'topic' => $topic
            ]) 
        ]);

        return view('forum/topic', [
            'messages' => $messages,
            'form' => $form
        ]);
    }

    public function writeMessage(Request $request, $topic)
    {
        $form = $this->form(MessageForm::class);
        $user = Auth::user();
        $users = User::get();
        $topicObj = Topic::find($topic)->get(); 
        foreach ($users as $key => $value) {
            if ($value->name === $user->name) {
                $users->forget($key);
            }
        }

        if($form->isValid()) {
            $message = new Message([
                'message' => $request->wysiwyg,
                'topic_id' => $topic
            ]); 

            $user->messages()->save($message);
            $message->save();

            Notification::send($users, new ForumNewMsg($message));

            return redirect()->route('forum_messages',[
                'topic' => $topic
            ]);
        }
    }
    public function deleteMessage($topic, $id)
    {
        $topicMessages = Message::where('topic_id', '=', $topic)->get();
        $cat = Topic::find($topic);
        $cat = $cat->category_id;

        //if check number of message in topic to delete topic if needed
        if (count($topicMessages) <= 1)
        {
            Message::where('id', '=', $id)->delete();
            Topic::where('id', '=', $topic)->delete();

            return redirect()->route('forum_cat', [
                'cat' => $cat
            ]);

        } else {
            Message::where('id', '=', $id)->delete();

            return redirect()->route('forum_messages',[
                    'topic' => $topic
                ]);
        }
    }

    public function updateMessage($topic, $id)
    {
        # code...
    }

    public function newTopic(FormBuilder $formBuilder, $cat)
    {
        $form = $this->form(TopicForm::class, [
            'method' => 'POST', 
            'url' => route('forum_insert_topic', [
                'cat' => $cat
            ])
        ]);

        return view('forum/topicCreation', [
            'form' => $form
        ]);
    }

    public function writeTopic(Request $request, $cat)
    {
        $form = $this->form(TopicForm::class);
        $user = Auth::user();
        // dd($user->id);
        $category = Category::find($cat);

        if($form->isValid()) {

            $topic = new Topic([
                'title' => $request->name,
                'locked' => false,
                'user_id' => $user->id
            ]); 
            
            $category->topics()->save($topic);
            $topic->save();

            $message = new Message([
                'message' => $request->wysiwyg,
                'topic_id' => $topic->id
            ]); 
            
            $user->messages()->save($message);
            $message->save();

            return redirect()->route('forum_messages',[
                'topic' => $topic
            ]);
        }
    }

    public function lockTopic($topic)
    {
        $topic = Topic::find($topic);
        $topic->locked = true;
        $topic->save();

        return redirect()->route('forum_cat', [
            'cat' => $topic->category_id
        ]);
    }

    public function unlockTopic($topic)
    {
        $topic = Topic::find($topic);
        $topic->locked = false;
        $topic->save();

        return redirect()->route('forum_cat', [
            'cat' => $topic->category_id
        ]);
    }

    public function banUser($id)
    {
        $user = $this->user->findOne($id);
        $role= $this->role->findOne(4);
        $role->users()->attach($user);
    
    }    
}
