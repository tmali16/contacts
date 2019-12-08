@extends('base_admin')

@section('content')
  @include('admin.nav')
    <div class="row">
      <div class="col s12 m2 l2 ">
        <div class="nav" style="top: 0px; bottom: 0px;">
          <div class="card ">
            <ul class="collection with-header" id="tabs">
              <li class="collection-header"><h4>Меню</h4></li>

              <li class="collection-item tab ">
                <div>
                  <span id="list">Список</span>
                </div>
              </li>
              
              <li class="collection-item tab">
                <div>
                  <span id="settings">Настройки</span>
                </div>
              </li>
              <li class="collection-item tab">
                
              </li>
              <div>
                  <span @click="modal = !modal">
                    <a class="waves-effect waves-light btn modal-trigger" href="#modal1" >Modal</a></span>
                </div>
            </ul>
          </div>
        </div>
      </div>

      <div class="col s12 m8 l9">
        <div class="row">
          <div class="tabs_content">
            
            <div class="tabs_content-item col s12 m10 l10 " id="listC">
              <new_person-component></new_person-component>
            </div>

            <div class="tabs_content-item col s12 m10 l10" id="settingsC">
              <creategu-component></creategu-component>
            </div>

          </div>
        </div>        
      </div>
    </div>
@endsection

@section("js")

<script>
$(document).ready(function() {    

  $('#tabs li span:not(:first)').addClass('tab_active');
  $('.tabs_content-item').hide();
  $('.tabs_content-item:first').show();
    
  $('#tabs .tab div span').click(function(){
      var t = $(this).attr('id');
    if($(this).hasClass('tab_active')){ //this is the start of our condition 
      $('#tabs li span').addClass('tab_active');           
      $(this).removeClass('tab_active');

      $('.tabs_content-item').hide();
      $('#'+ t + 'C').fadeIn('slow');
   }
  });


});

// Get the button that opens the modal
// function openModal() {
//   var modal = $("#modals_admin")
//   modal.show();
// }
// function closeModal(){
//   var modal = $("#modals_admin")
//   modal.hide();
// }

// $(window).click(function (event) {
//   var modal = $("#modals_admin")[0]  
//   if(event.target == modal)
//   $("#modals_admin").hide();
// })


</script>

@endsection