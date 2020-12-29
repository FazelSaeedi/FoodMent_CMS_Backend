@extends('V1.layouts.master')

@section('content')

    <div class="main-conteiner">

        <div class="form-group">
            <label >Email address</label>
            <input type="username" class="form-control" placeholder="Enter UserName">
        </div>

        <div class="form-group">
            <label >Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

@endsection

@section('css')

    <style>
        body{
            background-color: yellow;
        }
        html{
            background-color: yellow;
        }
        .main-conteiner {
            width: 500px;
            margin: auto;
            margin-top: 200px;
        }

        @media (max-width:500px){
            .main-conteiner {
                width: 500px;
                margin: auto;
                margin-top: 0px;
                padding: 72px;
            }
        }
    </style>

@endsection

@section('js')
    {{----}}
@endsection



