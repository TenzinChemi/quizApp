<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * List all the subjects
     * @return request
     *
     */
    public function index()
    {

    }
    /**
     * Add New Subjects
     */
    public function create(){
        $subject = Subject::all();

        return view('question.subject',[
            'subjects'=>$subject,
        ]);
    }

    /**
     *@param request
     *@return Response
     */

    public function store(Request $request){
        $request->validate([
            'subject' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($image = $request->file('image')) {
            $destinationPath = public_path('image');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        $subject=Subject::create([
            'subject' => $request->subject,
            'image' => $request->image,
        ]);

        return back()->with('success','Subject has been created');

    }
}
