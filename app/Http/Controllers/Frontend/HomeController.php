<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Field;
use App\Models\Staff;
use App\Models\Inbox;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;

class HomeController extends Controller
{
    public function singlePage(){
      return view('public.single');
    }
    public function listPage(){
      $tags = Tag::where('status', 'show')->get();
      $category = Category::where('status', 'show')->get();
      $articles = Article::where('status', 'show')->latest()->limit(5)->get();
      $post = Article::where('status', 'show')->latest()->paginate(10);
      return view('public.list', compact('category', 'tags', 'articles', 'post'));
    }

    public function index(){
      try{
        return view('public.index');
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('public.homepage')->with(['error' => $error]);
      }
    }

    public function contactUs(){
      try{
        return view('public.contact');
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('public.homepage')->with(['error' => $error]);
      }
    }

    public function sendMessage(Request $request){
      try{
        $data = [
              'name'      => $request->input('name'),
              'address'   => $request->input('address'),
              'email'     => $request->input('email'),
              'subject'   => $request->input('subject'),
              'message'   => $request->input('message'),
              'status'    => "unread"
        ];
        $inbox = Inbox::create($data);
        return redirect()->route('public.contact')->with(['success' => 'Pesan Berhasil Dikirim!']);
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->route('public.homepage')->with(['error' => $error]);
      }
    }

    public function field(){
      try{
        $fetch = Field::where('status', 'show')->get();
        return view('public.profil.bidang', compact('fetch'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error' => $error]);;
      }
    }

    public function staff($slug){
      try{
        $bidang = Field::where('slug', $slug)->first();
        $fetch = Staff::where(['field_id'=>$bidang->id, 'status'=>'show'])->get();
        return view('public.profil.pegawai', compact('fetch'));
      }catch(\Exception $e){
        $error = $e->getMessage();
        return redirect()->back()->with(['error' => $error]);;
      }
    }
}
