@extends('base')

@section("title")
Телефонный справочник
@endsection

@section("content")
@include('layouts.nav')
<div class="container main">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
            <div class="card shadow">
                <div class="card-body">
                    telephone
                </div>
            </div>
        </div>
    </div>
</div>


@endsection