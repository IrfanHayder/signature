@extends('components.main')
@section('main')
      
 <div class="game-box">
            <div class="col-md-12 offset-md-3 ml-0 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Signature Pad</h5>
                    </div>
                    <div class="card-body">
                         @if ($message = Session::get('success'))
                             <div class="alert alert-success  alert-dismissible" id="close">
                                 <button type="button" class="close"  data-dismiss="alert">×</button>  
                                 <strong >{{ $message }}</strong>
                             </div>
                         @endif
                         <form method="POST" action="{{ route('signaturepad.upload') }}" enctype="multipart/form-data" id="signatureForm">
                            @csrf
                             <div class="col-md-12 sig_main">


                                <label class="" for="">Name:</label>
                                <br/>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter Name" class="name"/>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                                <br/>


                                
                                <label class="" for="">Email:</label>
                                <br/>
                                <input type="email" name="email" placeholder="Enter Email" value="{{ old('email') }}" class="date"/>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                <br/>


                                <label class="" for="">Phone Number:</label>
                                <br/>
                                <input type="number" name="phone" value="{{ old('phone') }}" placeholder="Enter Phone Number" class="name"/>
                                @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                                <br/>




                                <label class="" for="">Signature:</label>
                                <br/>
                                {{-- <div id="sig" width="506" height="200" class="kbw-signature"></div> --}}
                                <canvas id="sig" width="500" height="200" class="kbw-signature"></canvas>
                                <br/>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                                @if ($errors->has('signed'))
                                <span class="text-danger">{{ $errors->first('signed') }}</span>
                                @endif
                                <br/>
                                <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                                
                             </div>
                             <br/>
                             <button type="submit" class="btn btn-success submit" name="submit">Save</button>
{{-- 
                             @php
                                 if (isset($_POST['submit'])) {
                                    header('loaction:download');
                                 }
                             @endphp --}}
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection




 