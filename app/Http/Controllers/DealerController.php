<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use App\Repositories\DealerRepositoryInterface;
use App\Repositories\HolidaySetRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DealerController extends BaseController
{
    protected $dealerRepository;
    protected $holidayRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DealerRepositoryInterface $dealerRepository, HolidaySetRepositoryInterface $holidayRepository)
    {
        $this->middleware('auth');
        $this->dealerRepository = $dealerRepository;
        $this->holidayRepository = $holidayRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Assuming 'per_page' is the name of your dropdown field

        if(!empty($request->input('search_key')) && $request->input('search_value')){
            $users = $this->dealerRepository->search($request->input('search_key'), $request->input('search_value'));
        }else{
            $users = $this->dealerRepository->getAll(true,$perPage);
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

        try {
            // Create the dealer record
            $data = $this->dealerRepository->create($request->all());

            // Flash success message to the session
            Session::flash('success', 'Dealer created successfully');
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            Session::flash('error', 'Failed to create data. Please try again.');
        }

        // Redirect back to the previous page
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dealer = $this->dealerRepository->findOne($id);
        $holidays = $this->holidayRepository->getAll(false);
        return view('dealers.update')->with([
            'dealer' => $dealer,
            'holidays' => $holidays
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if(empty($request->password)){
            $data = $request->except('password');
        }

        // Validation rules
        $rules = [
            'first_name'    => 'required|alpha',
            'last_name'     => 'required|string',
            'email'         => 'required|email',
            'office_phone'  => 'required|numeric',
            'office_address'=> 'required',
            'office_state'  => 'required',
            'office_city'   => 'required',
            'office_zip'    => 'required|numeric',
        ];

        // Validate the request
        $validator = Validator::make($data, $rules);

        // If validation fails, return error response
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            if(!empty($data['holiday_sets'])) {
                $data['holiday_sets'] = implode(',', $data['holiday_sets']);
            }

            // Create the dealer record
            $data = $this->dealerRepository->update($id, $data);

            // Flash success message to the session
            Session::flash('success', 'Dealer updated successfully');
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            Session::flash('error', 'Failed to update data. Please try again.'.$e->getMessage());
        }
        // Redirect back to the previous page
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dealer = $this->dealerRepository->delete($id);
        return $this->success('Delete Successfully');
    }

    /**
     * Search for dealers based on provided search key and value
     */
    public function search(Request $request){

        $searchKey = $request->input('search_key');
        $searchValue = $request->input('search_value');

        if(!empty($request->input('search_key')) && $request->input('search_value')){
            $users = $this->dealerRepository->search($searchKey, $searchValue);
        }else{
            $users = $this->dealerRepository->getAll(true);
        }


        // Render the blade view to HTML
        $view = view('dealers.dealer', ['users' => $users]);
        $html = $view->render();

        return response()->json(['html' => $html]);
    }

    public function exportToCSV()
    {
        // Retrieve data
        $dealers = $this->dealerRepository->getAll(false);

        // Define CSV headers
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=dealers.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        // Open output stream
        $output = fopen('php://output', 'w');

        // Add BOM to fix Excel UTF-8 issue
        fwrite($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Write headers
        fputcsv($output, ['id', 'First Name', 'Last Name', 'Email', 'Phone', 'Office Address', 'State', 'City', 'Zip', 'Created At']);

        // Write data
        foreach ($dealers as $dealer) {
            fputcsv($output, [$dealer->id, $dealer->first_name, $dealer->last_name, $dealer->email, $dealer->office_phone, $dealer->office_address, $dealer->office_state, $dealer->office_city, $dealer->office_zip, $dealer->created_at]);
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
