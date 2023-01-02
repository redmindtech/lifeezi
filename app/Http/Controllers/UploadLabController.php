<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\UploadLab;
use App\Models\UploadLabType;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Exception;
use App\Models\Onboarding;
class UploadLabController extends Controller
{

    public function getData($client = null) {
        $client->load(['summary', 'schedule_assement']);
        $onboarding = Onboarding::where('client_id', $client->id)->first();
        return [
            'client' => $client,
            'onboarding' => $onboarding 
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $clients = Client::whereIn('journey',['onboarding','observation', 'enquiry','planning','engagement','review'])->paginate(5);
            return view('pages.uploadlab.index',compact('clients'));
        }catch(Exception $e) {
           info($e->getMessage());
           return redirect()->route('upload.index')->with('error', 'Error occured in the upload index');
        } 
    }


    
    public function list(Client $client)
    {
        try{
            $data = $this->getData($client);
            return view('pages.uploadlab.list',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('upload.index')->with('error', 'Error occured in the upload list');
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        try{
            $data = $this->getData($client);
            return view('pages.uploadlab.create',compact('data'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('upload.index')->with('error', 'Error occured in the Upload create');
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadRequest $request)
    {
        try{
            $uploadlab = $request->only(UploadLab::REQUEST_INPUTS);
            $file = $request->file('upload_lab') ?? null;
            if ($file) {
                $extension = $request->file('upload_lab')->getClientOriginalExtension();
                $filename = Str::random(5) . '.' . $extension;
                $path = public_path() . '/assets/uploads/';
                public_path('/assets/uploads' . $file . '.png');
                $file->move($path, $filename);
                $uploadlab['upload_lab'] = $filename;
            }
            $uploadLab = UploadLab::create($uploadlab);
            $data = $request->only(UploadLabType::REQUEST_INPUTS);
            
             if($data['report_type'] ?? null) {
                foreach ($data['report_type'] as $key => $report_type) {
                    UploadLabType::create([
                        'upload_lab_id' => $uploadLab->id ?? null,
                        'upload_type' => $report_type ?? null,
                        'value' => $data['value'][$key] ?? null,
                        'comments' => $data['comments'][$key] ?? null,
                    ]);
                }
            }
            return redirect()->route('upload.index')->with('success', 'UploadLabReport Created Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('upload.index')->with('error', 'Error occured in the upload create');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uploadLab)
    {
         try{
            $uploadLab = UploadLab::findOrFail($uploadLab);
            $client = Client::findOrFail($uploadLab->client_id);
            $data = $this->getData($client);
            $uploadLab->load('upload_lab_type');
            return view('pages.uploadlab.show',compact('data', 'uploadLab'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('upload.index')->with('error', 'Error occured in the upload show');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uploadLab)
    {
        try{
            $uploadLab = UploadLab::findOrFail($uploadLab);
            $client = Client::findOrFail($uploadLab->client_id);
            $data = $this->getData($client);
            $uploadLab->load('upload_lab_type');
            return view('pages.uploadlab.edit',compact('data', 'uploadLab'));
        }catch(Exception $e) {
           info($e);
           return redirect()->route('upload.index')->with('error', 'Error occured in the upload edit');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uploadLab)
    {
        try{
            $uploadLab = UploadLab::findOrFail($uploadLab);
            $uploadlab = $request->only(UploadLab::REQUEST_INPUTS);
            $file = $request->file('upload_lab') ?? null;
            if ($file) {
                $extension = $request->file('upload_lab')->getClientOriginalExtension();
                $filename = Str::random(5) . '.' . $extension;
                $path = public_path() . '/assets/uploads/';
                public_path('/assets/uploads' . $file . '.png');
                $file->move($path, $filename);
                $uploadlab['upload_lab'] = $filename;
            }
            $uploadLab->update($uploadlab);
            $data = $request->only(UploadLabType::REQUEST_INPUTS);
                $ids = $request->input('ids');
             if($data['report_type'] ?? null) {
                foreach ($data['report_type'] as $key => $report_type) {
                    UploadLabType::updateOrCreate(
                     ['id' => $ids[$key] ?? null],[
                        'upload_lab_id' => $uploadLab->id ?? null,
                        'upload_type' => $report_type ?? null,
                        'value' => $data['value'][$key] ?? null,
                        'comments' => $data['comments'][$key] ?? null,
                    ]);
                }
            }

             $uploadLabs = $request->input('delete') ?? null;
            if($uploadLabs) {
                foreach($uploadLabs as $id){
                    $upload = UploadLabType::findOrFail($id);
                    $upload->delete();

                }
            }
            return redirect()->route('upload.index')->with('success', 'UploadLabReport Updated Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('upload.index')->with('error', 'Error occured in the upload create');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uploadLab)
    {
        try{
            $uploadLab = UploadLab::findOrFail($uploadLab);
            $uploadLab->upload_lab_type()->delete();
            $uploadLab->delete();
            return response()->json('Upload Lab Report Deleted Successfully');
        }catch(Exception $e) {
           info($e);
           return redirect()->route('upload.index')->with('error', 'Error occured in the observation destroy');
        }
    }

        public function getUpload() {
        try {
            $options = REPORT_TYPES;
            return response()->json(['data' => $options]);
        } catch (\Exception  $exception) {
            info($exception);
            return redirect()->back()->with('error', 'Error occurred. Please contact administrator');
        }
    }
        public function getUploadData()
    {
        try {
            $clients = Client::where('journey','onboarding')->with('upload_lab')->get();
            

            return Datatables::of($clients)
                ->editColumn('name', function ($client) {
                    return $client->client_name;
                })->editColumn('sex', function ($client) {
                return ucfirst($client->sex);
            })->editColumn('phone', function ($client) {
                return $client->mobile;
            })->editColumn('plan', function ($client) {
                return ucfirst(implode(' ', explode('_', $client->transformation_plan)));
            })->editColumn('uploadlab', function ($client) {
                return '<a href="' . route('upload.add', $client) . '" class="btn btn-primary  btn-sm"><i class="fa fa-file"></i> </a>';
            })->editColumn('view', function ($client) {
                    return '<a href="' . route('upload.list', $client) . '" class="btn btn-info  btn-sm"><i class="fa fa-eye"></i> </a>';
            })
            ->rawColumns(['uploadlab','view'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }

    public function getClientUpload($client)
    {
        try {
            $client = Client::findOrFail($client);
            $uploads = UploadLab::where('client_id', $client->id)->get();

            return Datatables::of($uploads)
                ->editColumn('test_date', function ($upload) {
                    return dateFormat($upload->test_date);
                })->editColumn('next_test_date', function ($upload) {
                return dateFormat($upload->next_test_date);
            })->editColumn('show', function ($upload) {
                return '<a href="' . route('upload.show', $upload) . '" class="btn btn-primary  btn-sm"><i class="fa fa-eye"></i> </a>';
            })->editColumn('edit', function ($upload) {
                return '<a href="' . route('upload.edit', $upload) . '" class="btn btn-success  btn-sm"> <i class="fa fa-user-pen "></i></a>';
            })->editColumn('delete', function ($upload) {
                return '<div class="form-group" ><button class="btn btn-danger  btn-sm" onclick=deleteUpload('. $upload->id .')  ><i class="fa fa-trash"></i></a></div>';
                  // return '<form method="POST"  onsubmit="return confirm("Are you sure want to delete the client?")" action="' . route('client.destroy',$client) .'">' . csrf_field() . method_field('DELETE') . '<div class="form-group"><button class="btn btn-danger" type="submit"><i class="fa fa-trash "></i></a></div></form> ';
                
            })->rawColumns(['show', 'edit','delete'])
                ->make(true);
        } catch (Exception $e) {
            info($e);
            return redirect()->route('client.index')->with('error', 'Error occured in the client store');
        }
    }
}