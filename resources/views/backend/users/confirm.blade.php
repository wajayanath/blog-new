 @extends('layouts.backend.main')

@section('title', 'MyBlog | Delete Confirmation')

@section('content')

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header"> 
        <h1>
          users
          <small>Delete Confirmation</small> 
        </h1>
        <ol class="breadcrumb">
          <li>
              <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
          </li>
          <li><a href="{{ route('backend.users.index') }}">users</a></li>
          <li class="active">Delete Confirmation</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
              {!! Form::model($user, [
                  'method' => 'DELETE',
                  'route'  => ['backend.users.destroy', $user->id],
              ]) !!}

                  <div class="col-xs-9">
                    <div class="box">
                      <div class="box-body ">
                        <p>
                          You have specified this user for deletion:
                        </p>
                        <p>
                          ID #{{ $user->id }}: {{ $user->name }}
                        </p>
                        <p>
                          What should done with content own by this user?
                        </p>
                        <p>
                          <input type="radio" name="delete_option" val ue="delete"> Delete all content
                        </p>
                        <p>
                          <input type="radio" name="delete_option" value="attribute"> Arribute content to 
                          {!! Form::select('select_user', App\User::pluck('name','id'), null) !!}
                        </p>
                      </div>
                    </div>
                  </div>

            {!! Form::close() !!}
          </div>
        <!-- ./row -->
      </section>
      <!-- /.content -->
    </div>

@endsection

