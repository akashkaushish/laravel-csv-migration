<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSellerRequest;
use App\Http\Requests\UpdateSellerRequest;
use App\Models\Seller;
use Illuminate\Http\Response;

class SellersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::all();
        return response()->json([
            'data' => $sellers
        ]);
    }
/**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $uuid = $request->id;
        if($uuid)
        {
            $seller = Seller::where('uuid', '=', $uuid)->first(); 
            return response()->json([
                'data' => $seller
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contacts(Request $request)
    {
        $uuid = $request->id; 
        if($uuid)
        {
            $seller = Seller::where('uuid', '=', $uuid)->first(); 
            return response()->json([
                'data' => [
                    'contact_customer_fullname' => $seller->contact_customer_fullname,
                    'contact_type' => $seller->contact_type,
                    'contact_product_type_offered_id' => $seller->contact_product_type_offered_id,
                    'contact_product_type_offered' => $seller->contact_product_type_offered,
                    'contact_date' => $seller->contact_date,
                    'contact_region' => $seller->contact_region,
                    'country' => $seller->country
                ]
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sales(Request $request)
    {
        $uuid = $request->id; 
        if($uuid)
        {
            $seller = Seller::where('uuid', '=', $uuid)->first(); 
            return response()->json([
                'data' => [
                    'seller_firstname' => $seller->seller_firstname,
                    'seller_lastname' => $seller->seller_lastname,
                    'seller_id' => $seller->seller_id,
                    'sale_net_amount' => $seller->sale_net_amount,
                    'sale_gross_amount' => $seller->sale_gross_amount,
                    'sale_tax_rate' => $seller->sale_tax_rate,
                    'sale_product_total_cost' => $seller->sale_product_total_cost
                ]
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function salesperyear(Request $request)
    {
        echo $requested_year = $request->year;  exit;
        if($uuid)
        {
            //Code will come here
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return 'am here ';
    }

    /**
     * Uploading a csv file to migrate data.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadContent(Request $request)
    { 
        $file = $request->file('uploaded_file'); 
        if($file){
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize(); //Get size of uploaded file in bytes

            //Check for file extension and size
            $valid_extension = ["csv"]; // Only csv file allowed
            $maxFileSize = 12582912; // Uploaded file size limit is 10mb

            if (!in_array(strtolower($extension), $valid_extension)) {
                return response()->json([
                    'error' => 'Invalid file extension.'], 415); exit;
            }
            if ($fileSize > $maxFileSize) {
                return response()->json([
                    'error' => 'File size is too large.'], 413); exit;
            }

            //Where uploaded file will be stored on the server 
            $location = 'uploads'; // "uploads" folder in public directory

            // Upload file
            $file->move($location, $filename);
            $filepath = public_path($location . "/" . $filename); 
            // Reading file
            $file = fopen($filepath, "r");
            
            $importData_arr = array(); // Read through the file and store the contents as an array
            $i = 0;

            //Read the contents of the uploaded file 
            while (($filedata = fgetcsv($file, 1000, ";")) !== FALSE) {
                $num = count($filedata);
                // Skip first row (Remove below comment if you want to skip the first row)
                if ($i == 0) {
                    $i++;
                    continue;
                }
                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file); //Close after reading
            $j = 0; 
            foreach ($importData_arr as $importData) {
                $j++;
                $user = Seller::where('uuid', '=', $importData[0]);
                if ($user === null) {
                    try {
                        if(trim($importData[0]) != ''){
                            DB::beginTransaction();

                            Seller::create([
                            'uuid' => $importData[0],
                            'seller_id' => $importData[1],
                            'seller_firstname' => $importData[2],
                            'seller_lastname' => $importData[3],
                            'date_joined' => $importData[4],
                            'country' => $importData[5],
                            'contact_region' => $importData[6],
                            'contact_date' => $importData[7],
                            'contact_customer_fullname' => $importData[8],
                            'contact_type' => $importData[9],
                            'contact_product_type_offered_id' => $importData[10],
                            'contact_product_type_offered' => $importData[11],
                            'sale_net_amount' => $importData[12],
                            'sale_gross_amount' => $importData[13],
                            'sale_tax_rate' => $importData[14],
                            'sale_product_total_cost' => $importData[15]
                            ]);
                            
                            DB::commit();
                        }
                    } catch (\Exception $e) {
                        //throw $th;
                        DB::rollBack();
                    }
                }
            }
            
            return response()->json([
                'message' => 'File imported successfully.'], 200); 
        }
        return response()->json([
            'error' => 'No file was uploaded.'], 413);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSellerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSellerRequest $request)
    {
        //
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSellerRequest  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSellerRequest $request, Seller $seller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        //
    }
}
