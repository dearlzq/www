@extends('index.layouts.shop')

@section('title', '注册')
@section('content')
    <!-- register -->
    <div class="pages section">
        <div class="container">
            <div class="pages-head">
                <h3>REGISTER</h3>
            </div>
            <div class="register">
                <div class="row">
                    <form class="col s12" action="{{url('/DoReg')}}" method="post">
                        @csrf
                        <div class="input-field">
                            <input type="text" class="validate" placeholder="NAME" name="user_name" required>
                        </div>
                        <div class="input-field">
                            <input type="email" placeholder="EMAIL" class="validate" name="email" required>
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="PASSWORD" class="validate" name="password" required>
                        </div>
                        <div><input type="submit" class="btn button-default" value="REGISTER"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end register -->


    <!-- loader -->
    <div id="fakeLoader"></div>
    <!-- end loader -->
@endsection
