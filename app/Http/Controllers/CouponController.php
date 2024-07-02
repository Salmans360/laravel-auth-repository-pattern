<?php

namespace App\Http\Controllers;

use App\Repositories\CouponRepositoryInterface;
use App\Repositories\DealerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    protected $couponRepository;
    protected $dealerRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CouponRepositoryInterface $couponRepository, DealerRepositoryInterface $dealerRepository)
    {
        $this->middleware('auth');
        $this->couponRepository = $couponRepository;
        $this->dealerRepository = $dealerRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $coupons = $this->couponRepository->getAll(true, $perPage);

        // If it's an AJAX request, return only the table HTML
        if ($request->ajax()) {
            return view('coupons.list')->with('coupons', $coupons)->render();
        }
        return view('coupons.index')->with('coupons', $coupons);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dealers = $this->dealerRepository->getAll();
        return view('coupons.create')->with('dealers', $dealers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //echo "<pre>"; print_r( $request->all() ); die;
        // Validation rules
        $rules = [
            'title'             => 'required',
            'dealer_id'         => 'required',
            'service_type'      => 'required',
            'barcode_text'      => 'required',
            'description'       => 'required',
            'expiration_date'   => 'required',
            'status'            => 'required',
            'renewal_options'   => 'required',
            'ppc'               => 'required',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, return error response
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Create the dealer record
            $coupon = $this->couponRepository->create($request->all());

            // Retrieve the locations list from the request
            $locationsList = $request->input('locationslist');

            // Associate each location with the newly created coupon
            foreach ($locationsList as $locationId) {
                // Save the association in the coupon_location table
                $coupon->locations()->attach($locationId);
            }

            // Flash success message to the session
            Session::flash('success', 'Coupon created successfully');
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            Session::flash('error', 'Failed to create data. Please try again.'.$e->getMessage());
        }

        // Redirect back to the listing page
        return redirect()->route('coupon.index');

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
        $coupon = $this->couponRepository->findOne($id);
        $dealers = $this->dealerRepository->getAll();
        return view('coupons.update')->with(['coupon' => $coupon, 'dealers' => $dealers]);
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
            $coupons = $this->couponRepository->search($searchKey, $searchValue);
        }else{
            $coupons = $this->couponRepository->getAll(true);
        }

        // Render the blade view to HTML
        $view = view('coupons.list', ['coupons' => $coupons]);
        $html = $view->render();

        return response()->json(['html' => $html]);
    }

    public function exportToCSV()
    {
        // Retrieve data
        $coupons = $this->couponRepository->getAll(false);

        // Define CSV headers
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=coupons.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        // Open output stream
        $output = fopen('php://output', 'w');

        // Add BOM to fix Excel UTF-8 issue
        fwrite($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Write headers
        fputcsv($output, ['id', 'Title', 'Description', 'Dealer ID', 'Dealer', 'Status', 'Service Type', 'Barcode Text', 'Coupon Footer', 'Expiration Date', 'Created At']);

        // Write data
        foreach ($coupons as $coupon) {
            fputcsv($output, [$coupon->id, $coupon->title, $coupon->description, $coupon->dealer_id, (!empty($coupon->dealer)) ? $coupon->dealer->fullname : '', ($coupon->status == 1) ? 'Active' : 'Inactive' , $coupon->service_type, $coupon->barcode_text, $coupon->coupon_footer, $coupon->expiration_date, $coupon->created_at]);
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
