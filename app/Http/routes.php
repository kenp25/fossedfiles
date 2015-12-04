


<?php
use App\Http\Requests;

Route::get('/', function () {
    Auth::logout();
    return View::make('index');
});


Route::post('/', function () {
    $credentials = array(
        'username' => Input::get('username'),
        'password' => Input::get('password')
    );
    $remember = Input::get('remember');
    if (Auth::attempt($credentials, $remember)) {
        return Redirect::intended('/welcome');
/*
        if(Auth::getUser()->type() == 'Admin'){
            return Redirect::intended('/admin');
            //
        }else{
            return Redirect::intended('/welcome');
        }*/

    } else {
        return Redirect::intended('/')->with('error', 'Invalid username or password');
    }
});

Route::get('/dashboard', function () {
    $sort = Input::get('sort', 'title');
    $order = Input::get('order', 'asc');
    global $system_document;
    $document_list = \App\DocumentList::get();
    $systems = \App\System::get();
    $users = \App\User::get();
    $system_id = Input::get('system_id');
    $user_id = Input::get('user');
    if (isset($system_id)){
        $system_document = \App\SystemDocument::where('type_no','=',$system_id)->paginate(10);
        //return Redirect::to('/dashboard');
    }elseif (isset($user_id)){
        $system_document = \App\SystemDocument::where('user_id','=',$user_id)->paginate(10);
    }else {
        $system_document = \App\SystemDocument::get();
    }
    return View::make('dashboard.index', array(
        'system_document' => $system_document,
        'document_list' => $document_list,
        'systems' => $systems,
        'sort' => $sort,
        'order' => $order,
        'users' => $users
    ));
});


Route::post('/upload', array('before' => 'csrf', function () {
    $input = Input::all();
    $validity = Validator::make($input, array(
        'title' => 'required',
        'system' => 'required|integer',
        'doc_type' => 'required|integer',
        'description' => 'required',
        /*'upload' => 'required',*/
        'upload' => 'required|mimes:txt,pdf,doc,docx,odt,ppt,pptx,odp,png,jpg,jpeg'
    ));
    if ($validity->fails()) {
        $messages = $validity->messages();
        return Redirect::to('/upload')->withErrors($validity);
    } else {
        if (Input::file('upload')->isValid()) {
            $file = Input::file('upload');
            $file_name = md5(time()) . '.' . $file->getClientOriginalExtension();
            $file_ext = $file->getClientOriginalExtension();
            $file->move(public_path() . '/docs', $file_name);
            \App\SystemDocument::create(array(
                'name' => $input['title'],
                'document_code' => $input['doc_type'],
                'system_code'=>$input['system'],
                'user_id' => $input['user'],
                'description' => $input['description'],
                'path' => '/docs/' . $file_name
            ));
            return Redirect::to('/welcome')->with('success', "Upload successful.");
        } else {
            return Redirect::to('/upload')->with('error', "Invalid File");
        }
    }
}));

Route::get('/delete/{id}',function($id){
    $deleted =App\Document::find($id);
    $deleted->delete();
    return Redirect::to('/dashboard')->with('message', "Deleted successfully");
});

Route::get('welcome',  ['middleware' => 'auth',function () {
    global $system_document;
    $document_list = \App\DocumentList::get();
    $systems = \App\System::get();
    $users = \App\User::get();
    $system_document = \App\SystemDocument::get();
    return View::make('dashboard.welcome', array(
        'system_document' => $system_document,
        'document_list' => $document_list,
        'systems' => $systems,
        'users' => $users
    ));
}]);

Route::get('/document',['middleware' => 'auth',function(){
    //retrieve system id
    $system_id = Input::get('system_id');
    //retrieve document id
    $doc_id = Input::get('doc_id');

    //find system with particular system id
    $system = \App\System::find($system_id);
    //find document type with particular document-type id
    $document_code = \App\DocumentList::find($doc_id);
    //retrieve particular docs after filtering by sytem id and doc id
    $system_documents = \App\SystemDocument::where('system_code','=',$system_id)->where('document_code','=',$doc_id)->get();
    return View::make('dashboard.document',array(
        'system_documents'=>$system_documents,
        'document_code'=>$document_code,
        'system'=>$system
    ));
}]);

Route::get('/upload',['middleware' => 'auth',function(){
    $document_list = \App\DocumentList::get();
    $systems = \App\System::get();
/*    if(Auth::guest()){
        return Redirect::intended('/')->with('message','Please login to continue');
    }*/
    return View::make('dashboard.upload',array(
        'document_list'=>$document_list,
        'systems'=>$systems
    ));
}]);

Route::get('/signup',function(){

    return View::make('dashboard.signup');
});

Route::post('/signup',function(){
    $input = Input::all();
    $validity = Validator::make($input, array(
        'firstname' => 'Required|Min:3|Max:80|Alpha',
        'lastname' => 'Required|Min:3|Max:80|Alpha',
        'username' => 'Required|Min:3|Unique:users',
        'password' => 'Required|AlphaNum|Between:4,8|Confirmed',
        'password_confirmation'=>'Required|AlphaNum|Between:4,8'
    ));

    if ($validity->fails()) {
        $messages = $validity->messages();
        return Redirect::to('/signup')->withErrors($validity);
    } else {
        \App\User::create(array(
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'username'=>$input['username'],
            'password' => Hash::make($input['password']),
        ));

        return Redirect::to('/signup')->with('success', "Registration successful.");
    }

});

Route::get('/searches',function(){
    $tag = Input::get('q');

    $systems = \App\System::
        where('tag','LIKE',"%,$tag,%")
        ->orWhere('tag','LIKE',"%,$tag%")
        ->orWhere('tag','LIKE',"%$tag,%")->get();
    /*dd($systems);*/

    $document_lists = \App\DocumentList::get();
    /*dd($systems);*/
    return View::make('dashboard.search', array(
        'systems' =>  $systems,
        'document_lists'=>$document_lists,
        'tag' => $tag
    ));
});

/*Route::get('/admin',['middleware' => 'auth',function(){

    global $system_document;
    $document_list = \App\DocumentList::get();
    $systems = \App\System::get();
    $users = \App\User::get();
    $system_document = \App\SystemDocument::get();
    if(Auth::getUser()->type() != 'Admin'){
        return Redirect::to ('/')->with('message','Please login as an admin to continue');
    }
    $users = App\User::get();
    return View::make('admin.index', array(
        'users'=> $users,
        'document_list' => $document_list,
        'systems' => $systems,
        'users' => $users
    ));
}]);*/

Route::get('/admin',['middleware' => 'auth',function(){
    if(Auth::getUser()->type() != 'Admin'){
        return Redirect::to ('/')->with('message','Please login as an admin to continue');
    }
    $users = App\User::get();
    return View::make('admin.users', array(
        'users'=> $users
    ));
}]);

Route::get('/admin/users/add',function(){
    $users = App\User::get();
    return View::make('admin.add_user', array(
        'users'=> $users
    ));
});

Route::get('/admin/users/edit/{id}',function($id){
    $users = App\User::find($id);
    return View::make('/admin.edit_user', array(
        'users'=> $users
    ));
});

Route::post('/admin/users/edit/{id}',function($id){
    $input = Input::all();
    $validity = Validator::make($input, array(
        'firstname' => 'Required|Min:3|Max:80',
        'lastname' => 'Required|Min:3|Max:80',
        'username' => 'Required|Min:3|Max:80',
        'user_type' => 'Min:3|Max:80',
    ));

    if ($validity->fails()) {
        $messages = $validity->messages();
        return Redirect::to('/admin/')->withErrors($validity);
    } else {
        \App\User::where('id', $id)->update(array(
            'firstname'    =>  $input['firstname'],
            'lastname' =>  $input['lastname'],
            'username'  => $input['username'],
            'type' => $input['user_type']
        ));

        return Redirect::to('/admin/')->with('success', "Update Successful.");
    }
});

Route::get('/admin/users/delete/{id}',function($id){
    $selected = \App\User::find($id);
    $selected->delete();
    return Redirect::to('admin');
});

Route::post('/admin/users/add',function(){
    $input = Input::all();
    $validity = Validator::make($input, array(
        'firstname' => 'Required|Min:3|Max:80|Alpha',
        'lastname' => 'Required|Min:3|Max:80|Alpha',
        'username' => 'Required|Min:3|Unique:users',
/*        'user_type' => 'Min:3|Unique:users',*/
        'password' => 'Required|AlphaNum|Between:4,8|Confirmed',
        'password_confirmation'=>'Required|AlphaNum|Between:4,8'
    ));

    if ($validity->fails()) {
        $messages = $validity->messages();
        return Redirect::back()->withInput()->withErrors($validity);
    } else {
        \App\User::create(array(
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'username'=>$input['username'],
            'password' => Hash::make($input['password']),
            /*'type' => $input['user_type'],*/
        ));

        return Redirect::to('/admin')->with('success', "successfully Added.");
    }
});

Route::get('/admin/systems',function(){
    $systems = App\System::get();
    return View::make('admin.systems', array(
        'systems'=> $systems
    ));
});

Route::get('/admin/types',function(){
    $document_lists = App\DocumentList::get();
    return View::make('admin.types', array(
        'document_lists'=> $document_lists
    ));
});

Route::get('/admin/docs',function(){
    $system_documents = App\SystemDocument::get();
    return View::make('admin.documents', array(
        'system_documents'=> $system_documents
    ));
});

Route::get('/admin/systems/edit/{id}',function($id){
    $systems = App\System::find($id);
    return View::make('admin.edit_systems', array(
        'systems'=> $systems
    ));
});

Route::post('/admin/systems/edit/{id}',function($id){
    $input = Input::all();
    $validity = Validator::make($input, array(
        'title' => 'Required|Min:3|Max:80',
        'description' => 'Min:3',
        'tag' => 'Min:3',
        'primary_owner' => 'Min:3|Max:30',
        'secondary_support' => 'Min:3|Max:30'
    ));

    if ($validity->fails()) {
        $messages = $validity->messages();
        return Redirect::back()->withErrors($validity);
    } else {
        \App\System::where('id', $id)->update(array(
            'name'    =>  $input['title'],
            'description' =>  $input['description'],
            'tag' => $input['tag'],
            'primary_owner' => $input['primary_owner'],
            'secondary_support' => $input['secondary_support'],
        ));

        return Redirect::to('/admin/systems')->with('success', "Update Successful.");
    }
});

Route::get('admin/systems/delete/{id}',function($id){
    $selected = App\System::find($id);
    $selected->delete();
    return Redirect::to('admin/systems');
});

Route::get('admin/systems/add',function(){
    return View::make('admin.add_system');
});

Route::post('admin/systems/add',function(){
    $input = Input::all();
    $validity = Validator::make($input, array(
        'name' => 'Required|Min:3|Max:80',
        'description' => 'Max:80',
        'tag' => 'Min:3',
        'primary_owner' => 'Min:3|Max:30',
        'secondary_support' => 'Min:3|Max:30'
    ));

    if ($validity->fails()) {
        $messages = $validity->messages();
        return Redirect::back()->withInput()->withErrors($validity);
    } else {
        \App\System::create(array(
            'name' => $input['name'],
            'description' => $input['description'],
            'tag' => $input['tag'],
            'primary_owner' => $input['primary_owner'],
            'secondary_support' => $input['secondary_support']
        ));

        return Redirect::to('/admin/systems')->with('success', "Successfully added");
    }
});

Route::get('/admin/types/edit/{id}',function($id){
    $document_lists = App\DocumentList::find($id);
    return View::make('admin.edit_types', array(
        'document_lists'=> $document_lists
    ));
});

Route::post('/admin/types/edit/{id}',function($id){
    $input = Input::all();
    $validity = Validator::make($input, array(
        'name' => 'Required|Min:3|Max:80',
        'description' => 'Max:100',
    ));

    if ($validity->fails()) {
        $messages = $validity->messages();
        return Redirect::back()->withErrors($validity);
    } else {
        \App\DocumentList::where('id', $id)->update(array(
            'name'    =>  $input['name'],
            'description' =>  $input['description'],
        ));

        return Redirect::to('/admin/types')->with('success', "Update Successful.");
    }
});

Route::get('admin/types/delete/{id}',function($id){
    $selected = \App\DocumentList::find($id);
/*    dd($selected);*/
    $selected->delete();
    return Redirect::to('admin/types');
});

Route::get('/admin/types/add',function(){
    return View::make('admin.add_types');
});

Route::post('/admin/types/add',function(){
    $input = Input::all();
    $validity = Validator::make($input, array(
        'name' => 'Required|Min:3|Max:80',
        'description' => 'Max:100',
    ));

    if ($validity->fails()) {
        $messages = $validity->messages();
        return Redirect::back()->withErrors($validity);
    } else {
        \App\DocumentList::create(array(
            'name'    =>  $input['name'],
            'description' =>  $input['description'],
        ));

        return Redirect::to('/admin/types')->with('success', "Added Successful.");
    }
});

Route::get('admin/docs/edit/{id}',function($id){
    $system_docs = \App\SystemDocument::find($id);
    return View::make('admin.edit_docs', array(
        'system_docs'=>$system_docs
    ));
});



Route::post('/admin/docs/edit/{id}',function($id){
    $input = Input::all();
    $validity = Validator::make($input, array(
        'name' => 'Required|Min:3|Max:80',
        'description' => 'Max:100',
    ));

    if ($validity->fails()) {
        $messages = $validity->messages();
        return Redirect::back()->withErrors($validity);
    } else {
        \App\SystemDocument::where('id', $id)->update(array(
            'name'    =>  $input['name'],
            'description' =>  $input['description'],
        ));

        return Redirect::to('/admin/docs')->with('success', "Update Successful.");
    }
});

Route::get('admin/docs/delete/{id}',function($id){
    $selected = \App\SystemDocument::find($id);
    $path = public_path().$selected->path;
    /*dd($path);*/
    $selected->delete();
    File::delete($path);
    return Redirect::to('admin/docs')->with('message','deleted');

});


Route::get('change_password',['middleware' => 'auth',function(){
/*    dd(Auth::user());*/
    return View::make('password');


}]);

Route::post('change_password',function(){
    $input = Input::all();
    $validity = Validator::make($input, array(
        'current_password' => 'Required',
        'password' => 'Required|AlphaNum|Between:4,8|Confirmed',
        'password_confirmation'=>'Required|AlphaNum|Between:4,8',
    ));
    if ($validity->fails()) {
        $messages = $validity->messages();
        return Redirect::back()->withErrors($validity)->withInput();
    } else {
        if(Hash::check($input['current_password'], Auth::user()->getAuthPassword())){
            \App\User::where('id', Auth::user()->id)->update(array(
                'password' => Hash::make($input['password'])
            ));

            return Redirect::to('change_password')
                ->with('success', 'Password changed successfully.');

        } else {
            return Redirect::to('change_password')
                ->with('error', 'Your current password is incorrect.');
        }
    }


});










