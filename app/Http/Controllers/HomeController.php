<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class HomeController extends Controller
{
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Assuming 'per_page' is the name of your dropdown field

        if(!empty($request->input('search_key')) && $request->input('search_value')){
            $users = $this->userRepository->search($request->input('search_key'), $request->input('search_value'));
        }else{
            $users = $this->userRepository->getAll(true,$perPage);
        }

        // If it's an AJAX request, return only the table HTML
        if ($request->ajax()) {
            return view('dealers.dealer')->with('users', $users)->render();
        }

        //return view('home');
        return view('home')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dealers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //echo "<pre>"; print_r($request->all()); die;
        // Validation rules
        $rules = [
            'first_name'    => 'required|alpha',
            'last_name'     => 'required|string',
            //'email'         => 'required|email|unique:dealers',
            'email'         => 'required|email',
            'password'      => 'required|min:6',
            'office_phone'  => 'required|numeric',
            'office_address'=> 'required',
            'office_state'  => 'required',
            'office_city'   => 'required',
            'office_zip'    => 'required|numeric',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, return error response
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
die;
        $data = $this->userRepository->create($request->all());
        return $this->success($data, 'Data created successfully');

    }

    public function search(Request $request){

        $searchKey = $request->input('search_key');
        $searchValue = $request->input('search_value');

        if(!empty($request->input('search_key')) && $request->input('search_value')){
            $users = $this->userRepository->search($searchKey, $searchValue);
        }else{
            $users = $this->userRepository->getAll(true);
        }


        // Render the blade view to HTML
        //$html = View::make('dealers.dealer', compact('users'))->render();
        $view = view('dealers.dealer', ['users' => $users]);
        $html = $view->render();

        return response()->json(['html' => $html]);
    }

    public function exportToCSV()
    {
        // Retrieve data
        $users = $this->userRepository->getAll(false);

// Define CSV headers
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=users.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        // Open output stream
        $output = fopen('php://output', 'w');

        // Add BOM to fix Excel UTF-8 issue
        fwrite($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Write headers
        fputcsv($output, ['id', 'First Name', 'Last Name', 'Email', 'Created At']);

        // Write data
        foreach ($users as $user) {
            fputcsv($output, [$user->id, $user->first_name, $user->last_name, $user->email, $user->created_at]);
        }

        // Close the stream
        fclose($output);

        // Return response
        return response()->stream(
            function () use ($output) {
                // Nothing to do here, as the stream is already closed outside
            },
            200,
            $headers
        );

    }
}
