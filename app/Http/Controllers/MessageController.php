<?php


namespace App\Http\Controllers;


use App\Http\Helpers\Helper;
use App\Model\Messages;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * @var Helper
     */
    private $helper;


    /**
     * UsersController constructor.
     */
    public function __construct(Helper $helper)
    {
        $this->middleware('auth');
        $this->middleware('localization');
        $this->helper = $helper;
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('message.home');
    }


    /**
     * @param $locale
     * @param  User  $user
     * @param  Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMessage(
        $locale,
        User $user,
        Request $request
    ): \Illuminate\Http\RedirectResponse
    {
        $message   = new Messages();
        $validator = Validator::make($request->all(), [
            'subject'     => 'nullable|string',
            'description' => 'required|string|min:3',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $message->sender_user_id = $this->helper->getCurrentUser()->id;
        $message->receiver_user_id = $user->id;
        $message->subject = $request->get('subject');
        $message->description = $request->get('description');

        $message->save();

        return redirect()->intended(route('users.details', [$locale, $user]));
    }


    /**
     * @param $locale
     * @param  User  $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($locale, Messages $message)
    {
        $message->delete();

        return redirect()->intended(route('message.inbox', [$locale]));
    }


	public function showDetails($locale, Messages $message)
	{
		$currentUser = $this->helper->getCurrentUser();

		$message->status = 1;
		$message->save();

		return view('message.details', [
			'user'    		 => $currentUser,
			'privateMessage' => $message,
			'locale' 		 => $locale
		]);

	}


	/**
	 * @param $locale
	 * @param  Messages  $oldMessage
	 * @param  Request  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function replyMessage(
        $locale,
        Messages $oldMessage,
        Request $request
    ): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'subject'     => 'nullable|string',
            'description' => 'required|string|min:3',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $message = new Messages();
        $message->sender_user_id   = $this->helper->getCurrentUser()->id;
        $message->receiver_user_id = $oldMessage->sender_user_id;
        $message->subject 		   = $request->get('subject');
        $message->description      = $request->get('description');
        $message->save();

		$oldMessage->reply = $message->id;
		$oldMessage->save();

        return redirect()->intended(route('message.inbox', [$locale]));
    }


    /**
     * @param  Request  $request
     *
     * @return false|string
     */
    public function dataTablesData(Request $request)
    {
        $currentUser = $this->helper->getCurrentUser();
        $messages    = Messages::where('receiver_user_id', $currentUser->id);
        $totalData   = $messages->count();

        $columns = [
            'sender_user_id',
            'subject',
            'create_at',
            'status',
            'action'
        ];

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $messages = $messages
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = $totalData;
        } else {
            $search = $request->input('search.value');

            $messages = $messages->Where('subject', 'like', "%{$search}%");
            //->orWhere('sender', 'like', "%{$search}%");

            $totalFiltered = $messages->count();

            $messages = $messages
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }

        $data = [];

        if ($messages) {
            foreach ($messages as $message) {
            	$sender = User::find($message->sender_user_id)->persian_name;
            	$reply  = $message->reply ? ' - replied': '';
                $data[] = [
                    'sender'     => $message->status ? $sender : '<h5>' . $sender . '</h5>',
                    'subject'    => $message->subject,
                    'created_at' => $message->created_at->format('d-m-Y'),
                    'status'     => $message->status ? 'Read'.$reply : '<span class="text-info">New</span>',
                    'action'     => '
                                        <a class="btn btn-xs btn-primary" style="float: left;"
                                           href="' . route('message.details',
                                            [session()->get('locale') ?? 'fas',$message->id]) . '" data-toggle="tooltip"
                                           data-placement="top">
                                            <i class="cil-envelope-closed" title="Display Message"></i>
                                        </a>
                                         <a class="btn btn-xs btn-danger" style="float: left;" onclick="return confirm(\'Delete this record?\')"
                                           href="' . route('message.destroy',
                                                [session()->get('locale') ?? 'fas', $message->id])
                                            . '" data-toggle="tooltip"
                                           data-placement="top">
                                            <i class="cil-trash" title="Delete"></i>
                                        </a>
                                    ',
                ];
            }
        }

        $json_data = [
            'draw'            => (int) ($request->input('draw')),
            'recordsTotal'    => (int) $totalData,
            'recordsFiltered' => (int) $totalFiltered,
            'data'            => $data,
        ];

        return json_encode($json_data);
    }
}
