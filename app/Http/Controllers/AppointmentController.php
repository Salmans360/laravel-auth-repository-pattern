<?php

namespace App\Http\Controllers;

use App\Repositories\AppointmentRepositoryInterface;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $appointmentRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AppointmentRepositoryInterface $appointmentRepository)
    {
        $this->middleware('auth');
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $appointments = $this->appointmentRepository->getAll(true, $perPage);

        // If it's an AJAX request, return only the table HTML
        if ($request->ajax()) {
            return view('appointments.list')->with('appointments', $appointments)->render();
        }
        return view('appointments.index')->with('appointments', $appointments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Search for dealers based on provided search key and value
     */
    public function search(Request $request){

        $searchKey = $request->input('search_key');
        $searchValue = $request->input('search_value');

        if(!empty($request->input('search_key')) && $request->input('search_value')){
            $appointments = $this->appointmentRepository->search($searchKey, $searchValue);
        }else{
            $appointments = $this->appointmentRepository->getAll(true);
        }


        // Render the blade view to HTML
        $view = view('appointments.list', ['appointments' => $appointments]);
        $html = $view->render();

        return response()->json(['html' => $html]);
    }

    public function exportToCSV()
    {
        // Retrieve data
        $appointments = $this->appointmentRepository->getAll(false);

        // Define CSV headers
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=appointments.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        // Open output stream
        $output = fopen('php://output', 'w');

        // Add BOM to fix Excel UTF-8 issue
        fwrite($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Write headers
        fputcsv($output, ['id', 'Location ID', 'Dealer ID', 'market ID', 'Drop Off', 'Request Date Time', 'Requested Services', 'Comments',
            'Vehicle Year', 'Vehicle Make', 'Vehicle Model', 'Vehicle Option',
            'First Name', 'Last Name', 'Email', 'Phone', 'Preferred Contact Method',  'Created At']);

        // Write data
        foreach ($appointments as $appointment) {
            fputcsv($output, [$appointment->id, $appointment->location_id, $appointment->dealer_id, $appointment->market_id, $appointment->drop_off,
                $appointment->request_datetime, $appointment->requested_services, $appointment->comments, $appointment->vehicle_year, $appointment->vehicle_make,
                $appointment->vehicle_model, $appointment->vehicle_option, $appointment->first_name, $appointment->last_name, $appointment->email, $appointment->phone,
                $appointment->preferred_contact_method, $appointment->created_at]);
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
