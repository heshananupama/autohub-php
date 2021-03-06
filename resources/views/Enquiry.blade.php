@extends('index')

@section('content')
    <div class="container">

        <div class="row">
            @if(Session::has('flash_message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <strong> {!! session('flash_message') !!} </strong>
                </div>
            @endif
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <strong>There were some problems</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach($errors->all() as $error)

                            <li>{{$error}}</li>

                        @endforeach
                    </ul>

                </div>
            @endif

        </div>
        <div class="row">
            <h1>Enquiries</h1>
        </div>

        <div class="row">

            <br><br>
            <form role="form" action="{{ url('/enquiry') }}" method="post">{{ csrf_field() }}
                <div class="col-xs-2">

                </div>
                <div class="col-xs-8">
                    <div class="well well-sm"><strong><i class="glyphicon glyphicon-ok form-control-feedback"></i>
                            Required Field</strong></div>

                    <div class="form-group">
                        <label for="ContactNo">Contact Number:</label>
                        <div class="input-group">
                            <input type="text"   maxlength="10" class="form-control" value="{{old('contactNo')}}"  placeholder="Enter Contact No." name="contactNo"
                                   id="ContactNo" required>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="InputMessage">Message</label>
                        <div class="input-group">
                            <textarea name="message" id="InputMessage"  class="form-control" rows="5"
                                      required></textarea>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span>
                        </div>
                    </div>

                    <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
                </div>
            </form>
            <hr class="featurette-divider hidden-lg">

        </div>
        <div class="col-xs-2">

        </div>

    </div>
    <br><br><br>
@endsection