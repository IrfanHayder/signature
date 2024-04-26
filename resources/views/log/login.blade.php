@extends('components.main')




@section('main')
<style>
.container{
    width: 400px;
    padding: 14px 0px;
}
.login{
    width: 90%;
}
.login h2{
    color: #5e63ba;
    font-weight: 600
}
.login form{
    padding: 20px
}
.btn-primary {
    color: #fff;
    background-color: #5e63ba;
    border-color: #5e63ba;
}
</style>
<div class="login">
    <h2 >Login:</h2>
<form method="POST" action="{{ route('signature.list') }}">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>

    <div style="text-align: center"><button type="submit" class="btn btn-primary">Submit</button></div>
  </form>
</div>
@endsection