<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CompetetionWiner;
use App\Models\Competiotion;
use App\Models\CompetiotionsAnswer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class CompetitionController extends Controller
{
    function competitionList() {
        try {
            $competitions = Competiotion::where('deleteStatuse','0')->orderBy('created_at', 'desc')->get();
           return view('Admin.Competition.competitionList',[
              'competitions'=>$competitions
           ]);
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
    }

    function competitionCreate() {
        try {
            $competiotion = Competiotion::count();

            if ($competiotion==0) {
                $lastNumber =1;
            } else {
                $lastCompetition = Competiotion::orderBy('created_at', 'desc')->first();
               $lastNumber = $lastCompetition->number +1;
            }
            
            
            
           return view('Admin.Competition.competitionCreate',[
                'competiotion' => $competiotion,
                 'lastNumber' => $lastNumber,
            ]);
        } catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
    }


    function competitionInsert(Request $request) {
        try {
            
            $competiotion = new Competiotion();

            $competiotionCount = Competiotion::count();
            if ($competiotionCount == 0) {
                $lastNumber = 1;
            } else {
                $lastCompetition = Competiotion::orderBy('created_at', 'desc')->first();
                $lastNumber = $lastCompetition->number +1;
            }
            
          
            $request->validate([
                'title' => [
                            'required',
                            'string',
                            Rule::unique('competiotions')->where(function ($query) {
                             return $query->where('deleteStatuse', 0);
                        }),],
                'description' => 'required|string',
            ]);
             $competiotion->title =$request->title;
             $competiotion->description =$request->description;
             $competiotion->answer =$request->answer;
             $competiotion->number = $lastNumber;
             $competiotion->save();

             $title = __('messages.competition_added_title');
             $message = __('messages.competition_added_message');
             Alert::html($title, $message, 'success')->persistent(true);

            
           return redirect()->route('competition_list');
        } 
        catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            $title = __('messages.validation_error_title');
            $message = '<ul>';
            foreach ($errors as $error) {
                $message .= "<li>$error</li>";
            }
            $message .= '</ul>';
            Alert::html($title, $message, 'error')->persistent(true);
    
            return back()->withErrors($e->validator)->withInput();
        }
        catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
    }


    function competitionUpdate(Request $request,$id)  {

        try {
            $competiotion = Competiotion::findorfail($id);

        if (($request->title && $request->title != $competiotion->title) ) {
            $request->validate([
                'title' =>[ 'required','string',
                Rule::unique('competiotions')->ignore($competiotion->id)->where(function ($query) {
                    return $query->where('deleteStatuse', '0');
                    
                })],
               
               ]);
        }



           $competiotion->title =$request->title;
            $competiotion->description = $request->description;
            $competiotion->answer = $request->answer;
            //  $competiotion->number = $lastNumber;
             $competiotion->update();


        $title = __('messages.competition_update_title');
        $message = __('messages.competition_update_message');
        Alert::html($title, $message, 'success')->persistent(true);

        return redirect()->route('competition_list');
        } 
        catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            $title = __('messages.validation_error_title');
            $message = '<ul>';
            foreach ($errors as $error) {
                $message .= "<li>$error</li>";
            }
            $message .= '</ul>';
            Alert::html($title, $message, 'error')->persistent(true);
    
            return back()->withErrors($e->validator)->withInput();
        }
        catch (Throwable $th) {
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
       
    }



    public function competitionDelete($id) {
        try {
           $competiotion = Competiotion::findorfail($id);
           $competiotion->deleteStatuse = '1';
           $competiotion->save();
    
      
          $title = __('messages.competition_delete_title');
          $message = __('messages.competition_delete_message');

          Alert::html($title, $message, 'success')->persistent(true);
        
         return redirect()->route('competition_list');

        } catch (\Throwable $th) {
           return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }
       
    }

    public function competitionAnswers($id) {
        $competeionAnswers = CompetiotionsAnswer::where('competiotion_id',$id)->get();

        return view('Admin.Competition.competiotionAnswers',[
            'competeionAnswers' =>$competeionAnswers,
        ]);

    }

   public function competitionWiners($id){
        $competeionAnswers = CompetiotionsAnswer::where('competiotion_id', $id)->get();
        $competeion = Competiotion::where('id', $id)->first();
        $competeionWinners = CompetetionWiner::where('competetion_id', $id)->get();
        // $competitions = Competiotion::where('deleteStatuse', '0')->orderBy('created_at', 'desc')->get();

        return view('Admin.Competition.competitionWinres',[
            // 'competitions'=> $competitions,
            'competeionAnswers'=> $competeionAnswers,
            'competeionWinners'=> $competeionWinners,
            'competeion'=> $competeion,
        ]);
   }


    public function deletefilePond(Request $request)
    {
        $fileName = $request->file_name;
        $directory = $request->directory;

        if ($fileName && $directory) {
            $filePath = public_path($directory . $fileName);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        return response()->json(['success' => true]);
    }


    public function uploadFiles(UploadedFile $file, string $directory)
    {
        $randomNumber = random_int(100, 9999);
        $filename = time() . '-' . $randomNumber . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $filename);

        return $filename;
    }


    public function uploadFileName(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:rar,zip',
        ]);

        $fileName = $this->uploadFiles($request->file, 'Files/Winers');

        return response()->json(['success' => true, 'fileName' => $fileName]);
    }


    public function competitionWinersInsert(Request $request) {
        
      
        $competetion_id = $request->compet_id;
        
        $request->validate([
            'user_id'=>'required',
            Rule::unique('competetion_winers')->where(function ($query)use ($competetion_id) {
                return $query->where('competetion_id', $competetion_id);
            })
        ]);
        try {
            $winer = new CompetetionWiner();
            $winer->file= $request->file_name;
            $winer->discreption= $request->discription;
            $winer->user_id= $request->user_id;
            $winer->competetion_id= $competetion_id;
            $winer->save();

            $title = __('messages.winer_added_title');
            $message = __('messages.winer_added_message');
            Alert::html($title, $message, 'success')->persistent(true);

            return redirect()->back();
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                $title = __('messages.validation_error_title');
                $message = __('messages.Duplicat_user');
                Alert::html($title, $message, 'error')->persistent(true);
                return redirect()->back();
            }
            // return redirect()->back()->withErrors(['error' => 'An unexpected error occurred. Please try again later.'])->withInput();
        }
        catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            $title = __('messages.validation_error_title');
            $message = '<ul>';
            foreach ($errors as $error) {
                $message .= "<li>$error</li>";
            }
            $message .= '</ul>';
            Alert::html($title, $message, 'error')->persistent(true);

            return back()->withErrors($e->validator)->withInput();
        }
        
         catch (Throwable $th) {
            
            return abort(403, 'مشکلی پیش آمده لطفا   دوباره تلاش کنید.');
        }


    }
    
}
