<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Topic;
use App\Message;
use App\Category;
use App\Forms\TopicForm;
use App\Forms\MessageForm;
use Illuminate\Http\Request;
use App\Notifications\ForumNewMsg;
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

    /**
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function index()
    {
        $cats = Category::get();
        $user = Auth::user();
        $notifs = [];

        foreach ($cats as $category)
        {
            if(!empty($user->notifications))
            {
                foreach ($user->notifications as $notif)
                {
                    if ($notif->data['category_id'] == $category->id)
                    {
                        $notifs[] = $notif->data['category_id'];
                    }
                }
            }
        }

        return view('forum/index', [
            'categories' => $cats,
            'notifs' => $notifs
        ]);
    }

    /**
     * @param $cat
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function showCat($cat)
    {
        $forumCategory = Category::find($cat);
        $catTopics = Topic::where('category_id', '=', $cat)->get();
        $user = Auth::user();
        $notifs = [];

        foreach ($catTopics as $topic)
        {
            if(!empty($user->notifications))
            {
                foreach ($user->notifications as $notif)
                {
                    if ($notif->data['topic_id'] == $topic->id)
                    {
                        $notifs[] = $notif->data['topic_id'];
                    }
                }
            }
        }

        return view('forum/category', [
            'cat' => $forumCategory,
            'topics' => $catTopics,
            'notifs' => $notifs
        ]);
    }


    use FormBuilderTrait;
    /**
     * @param FormBuilder $formBuilder
     * @param $topic
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function showMessages(FormBuilder $formBuilder, $topic)
    {
        $messages = Message::where('topic_id', '=', $topic)->get();
        $user = Auth::user();

        foreach ($messages as $message)
        {
            if(!empty($user->notifications))
            {
                foreach ($user->notifications as $notif)
                {
                    if ($notif->data['topic_id'] == $message->topic_id)
                    {
                        $notif->delete();
                    }
                }
            }
        }

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

    /**
     * @param Request $request
     * @param $topic
     * @return \Illuminate\Http\RedirectResponse
     */
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

            Notification::send($users, new ForumNewMsg($message));

            return redirect()->route('forum_messages',[
                'topic' => $topic
            ]);
        }
    }

    /**
     * @param $topic
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @param FormBuilder $formBuilder
     * @param $cat
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
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

    /**
     * @param Request $request
     * @param $cat
     * @return \Illuminate\Http\RedirectResponse
     */
    public function writeTopic(Request $request, $cat)
    {
        $form = $this->form(TopicForm::class);
        $user = Auth::user();
        $users = User::get();
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

            Notification::send($users, new ForumNewMsg($message));

            return redirect()->route('forum_messages',[
                'topic' => $topic
            ]);
        }
    }

    /**
     * @param $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lockTopic($topic)
    {
        $topic = Topic::find($topic);
        $topic->locked = true;
        $topic->save();

        return redirect()->route('forum_cat', [
            'cat' => $topic->category_id
        ]);
    }

    /**
     * @param $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlockTopic($topic)
    {
        $topic = Topic::find($topic);
        $topic->locked = false;
        $topic->save();

        return redirect()->route('forum_cat', [
            'cat' => $topic->category_id
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function banUser($id)
    {
        $user = User::find($id);
        $role = Role::find(4);
        $userRole = $user->roles()->get();
        $banner = Auth::user()->roles()->get();

        if ($userRole->contains(1))
        {
            return redirect()->back()->with('error', $user->name . ' is an administrator and cannot be banned');
        } elseif ($userRole->contains(2) && $banner->contains(2))
        {
            return redirect()->back()->with('error', 'you don\'t have the right to ban that user.');
        } else
        {
            foreach ($userRole as $currentRole)
            {
                $user->roles()->detach($currentRole);
            }

            $user->roles()->attach($role);
        }

        return redirect()->back()->with('success', $user->name . ' has been banned');
    }

    public function unban($id)
    {
        $user = User::find($id);
        $user->roles()->detach(4);
        $user->roles()->attach(3);

        return redirect()->back()->with('success', $user->name . ' has been unbanned');
    }
}
