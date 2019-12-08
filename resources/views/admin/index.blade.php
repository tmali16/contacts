@extends('base_admin')

@section('content')
  @include('admin.nav')
  <div class="container-fluid mt-5">
    <div class="row">
      <div class="col-md-2 ">
        <div class="border shadow" style="top: 0px; bottom: 0px; ">      
          <div class="list-group list-group-flush" id="list-tab" role="tablist" style="border-radius: 0px;">
            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-contact" role="tab" aria-controls="list-contact">Home</a>
            <a class="list-group-item list-group-item-action" id="list-setting-list" data-toggle="list" href="#list-setting" role="tab" aria-controls="list-settings">Settings</a>
          </div>
        </div>
      </div>
      <div class="col-md-10">
        <div class="">
          <div class="tab-content">            
            <div class="tab-pane fade  show active" id="list-contact" role="tabpanel" aria-labelledby="list-contact-list">
              <creategu-component></creategu-component>
            </div>
            <div class="tab-pane fade " id="list-setting" role="tabpanel" aria-labelledby="list-settings-list">
              <div class="col-md-12">
                
              </div>
            </div>
          </div>
        </div>        
      </div>
    </div>
  </div>
@endsection

@section("js")

@endsection