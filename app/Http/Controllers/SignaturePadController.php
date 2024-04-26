<?php

namespace App\Http\Controllers;
//use App\Mail\MailExample;
use Illuminate\Support\Facades\File;;
use Illuminate\Http\Request;
use App\Models\Signature;
use PDF;
use Mail;

class SignaturePadController extends Controller
{
   /**
     * Write code on Method
     *
     * @return response()
     */


    public $getname ;
    public $getsigned ;
    public function index()
    {
        return view('signaturePad');
    }
   
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function upload(Request $request)
{
    // Validation
    $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'signed' => 'required'
    ]);

    // Store image in the upload folder
    $folderPath = public_path('upload/');
    $image_parts = explode(";base64,", $request->signed);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $file = $folderPath . uniqid() . '.' . $image_type;
    file_put_contents($file, $image_base64);


    //create current date
    $date = now()->format('Y-m-d');


    //create pdf  and  save it in public/pdf folder
    $pdf_signature = Signature::all();
    $pdf = PDF::loadView('index', compact('pdf_signature'));
    // Generate PDF content
    $pdfContent = $pdf->output();
    
    $filePath = public_path('pdf/Bareboat Liability Waiver and Release Form'.uniqid().'.pdf'); 
    
    // Check if the file was saved successfully
    file_put_contents($filePath, $pdfContent);






    $filePath = public_path('pdf'); 
    $files = File::allFiles($filePath);
   

    // Loop through the files and do something with them
    foreach ($files as $key => $file) {
        // Get the file name
        //dd($file->getFilename());
        $pdfFileName = $file->getFilename();
        // Do something with the file name, e.g., display it or process it
        //echo $pdfFileName . '<br>';
    }



    //dd($this->getsigned);

    // Create a new Signature  and save it to the database
    $signature = new Signature;
    $signature->name = $request->name;// store name in database
    $signature->signed = $request->signed ;// store signature_pic in database
    $signature->phone = $request->phone;// store name in database
    $signature->email = $request->email;// store email in database
    $signature->date = $date;// store date in database
    $signature->pdf = $pdfFileName;
    $signature->save(); // Save to the database

  






    // email
    $data["email"] = $request->email;
    $data["title"] = "Your Signature";

    $pdfContent = $pdf->output(); // Get the PDF content

    // Save the PDF to a temporary file
    $filePath = tempnam(sys_get_temp_dir(), 'pdf_');
    file_put_contents($filePath, $pdfContent);

    $data["pdf"] = $filePath;

    Mail::send('email.mytest', $data, function ($message) use ($data) {
        $message->to($data["email"])
            ->subject($data["title"])
            ->attach($data["pdf"], ['as' => 'Bareboat Liability Waiver and Release Form.pdf']); // Attach the PDF with a name
    });




   ///  Email setup
    // $data["email"] = $request->email;
    // $data["title"] = "Your Signature";

    // //$filePath = public_path('pdf'); 
    // $data["pdf"] = $pdf->output() . 'current.pdf';


    // //$files =$files;//[
    //     // public_path('attachments/test_image.jpeg'),
    //    // public_path('pdf/'),
    // //];

    // Mail::send('email.mytest', $data, function($message)use($data, $files) {
    //     $message->to($data["email"])
    //             ->subject($data["title"])
    //             ->attach($data["pdf"] );

    //    // foreach ($files as $file){
    //    // }            
    // });

    //echo "Mail send successfully !!";










   //add values in sessions
//    session(['signature_signed' => $signature->signed]); //image
//    session(['signature_name' => $request->name]); //name
//    session(['signature_email' => $request->email]);// email
//    session(['signature_date' => $date]);//current date
   

    //return redirect to download-pdf route
    return back()->with('success', 'Success! Signature uploaded successfully');//redirect('download-pdf');//->view('pdf',compact('files'));
}






// public function pdf()
// {

//     return view('index', [
//         'name' => $this->getname,
//         'sign' => $this->getsigned,
//     ]);
    
//}

// this method is use for download the PDF


// public function pdf_save(){
//     // download
//     // $pdf_signature = Signature::all()->first;
//     // $pdf = PDF::loadView('index', compact('pdf_signature'));
//     // // dd($pdf);
//     // // Generate PDF content
//     // $pdfContent = $pdf->output();
    
 

//     // $filePath = public_path('pdf/Bareboat Liability Waiver and Release Form'.uniqid().'.pdf'); 
    
//     // // Check if the file was saved successfully
//     // file_put_contents($filePath, $pdfContent);// Save the PDF content to the file
 
//         // File was saved successfully
//         return back()->with('success', 'Success! Signature uploaded successfully');


// }
    






//get data form public/pdf

public function list(){
    $filePath = public_path('pdf'); 
    $files = File::allFiles($filePath);

    $signature_list = Signature::get();
    return view('list',['signatures' => $signature_list], compact('files'));
}


// public function signature_pdf(){


    
    
//     $signature_pdf = Signature::get();
//     return view('pdf',['signature_pdf' => $signature_pdf]);
// }



//this method is used for deleting data from database
//  public function delete($id) {
//     $Signature_id = Signature::where('id', $id)->first();
//     $Signature_id->delete();
//     return back()->withsucess('Product DELETED !!!!');
//   }


}
