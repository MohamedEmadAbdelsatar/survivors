@extends('admin/layouts.master')
@section('title','Dashboard')
@section('pageTitle','Dashboard')
@section('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

@endsection
@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Pending Orders
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                <a href="{{route('orders/pending')}}" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Pending Orders
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    Pending Orders
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body">
        <!--begin: Search Form -->
        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
            <div class="row align-items-center">
                <div class="col-xl-8 order-2 order-xl-1">
                    <div class="form-group m-form__group row align-items-center">

                        <div class="col-md-4">
                            <div class="m-input-icon m-input-icon--left">
                                <input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                    <span>
                                        <i class="la la-search"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end: Search Form -->
<!--begin: Datatable -->
<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
        <table class="m-datatable__table" style="display: block; min-height: 300px; overflow-x: auto;">
            <thead class="m-datatable__head"><tr class="m-datatable__row" style="height: 56px;">
                <th data-field="ID" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 50px;">#</span></th>
                <th data-field="Hospital_Name" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 130px;">Hospital Name</span></th>
                <th data-field="User" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 80px;">User</span></th>
                <th data-field="Blood Type" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 110px;">Blood Type</span></th>
                <th data-field="Amount" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">Amount</span></th>
                <th data-field="To" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">To</span></th>
                <th data-field="Actions" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 160px;">Actions</span></th>
            </thead>
            {{csrf_field()}}
        <tbody class="m-datatable__body" style="">
            @foreach($orders as $order)
            <tr data-row="0" class="m-datatable__row" style="height: 64px;" id="{{$order->id}}">
                <td data-field="ID" class="m-datatable__cell"><span style="width: 50px;">{{$loop->index+1}}</span></td>
                <td data-field="Hospital" class="m-datatable__cell"><span style="width: 130px;">@foreach($hospitals as $hospital) @if($hospital->id == $order->hospital_id){{$hospital->name}}@endif @endforeach</span></td>
                <td data-field="User" class="m-datatable__cell"><span style="width: 80px;">@foreach($users as $user) @if($user->id == $order->user_id){{$user->name}}@endif @endforeach</span></td>
                <td data-field="BloodType" class="m-datatable__cell"><span style="width: 110px;">@switch($order->blood_type)
                    @case(1) {{"O+"}} @break
                    @case(2) {{"O-"}} @break
                    @case(3) {{"A+"}} @break
                    @case(4) {{"A-"}} @break
                    @case(5) {{"B+"}} @break
                    @case(6) {{"B-"}} @break
                    @case(7) {{"AB+"}} @break
                    @case(8) {{"AB-"}} @break
                    @endswitch</span></td>
                <td data-field="Amount" class="m-datatable__cell"><span style="width: 100px;">{{$order->amount}}</span></td>
                <td data-field="To" class="m-datatable__cell"><span style="width: 100px;">@foreach($hospitals as $hospital) @if($hospital->id == $order->to_id){{$hospital->name}}@endif @endforeach</span></td>
                <td data-field="Actions" class="m-datatable__cell"><button type="button" class="btn btn-success accept" data-toggle="modal" data-target="#myModal" style="margin-right:5px;margin-left:5px;">Accept</button><button type="button" class="btn btn-danger refuse" style="margin-right:5px;margin-left:5px;" data-toggle="modal" data-target="#myModal2">Refuse</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<input type="hidden" name="buffer">
        <!--end: Datatable -->
    </div>
</div>
  <div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Accept The order</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <label>Enter The price</label>
            <input type="number" class="form-control m-input" @if(count($orders) != 0) id="{{$order->id}}" @endif placeholder="Enter Price" name="price">
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success submitmod" style="margin-right:5px;margin-left:5px;float:left;" onclick="sendaccept();" data-dismiss="modal">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  <div class="modal" id="myModal2">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Refuse The order</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <label>Enter Your comment</label>
            <input type="text" class="form-control m-input" @if(count($orders) != 0) id="{{$order->id}}" @endif placeholder="Enter Your Comment" name="comment">
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success submitmod" style="margin-right:5px;margin-left:5px;float:left;" onclick="sendrefuse();" data-dismiss="modal">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  <div class="modal" id="myModal3">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Order Accepted</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <p>You accepted this order</p>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  <div class="modal" id="myModal4">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Order Refused</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <P>no enough blood bags</P>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  <div class="modal" id="myModal5">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Order Refused</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <p>You refused this order</p>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

@endsection
@section('scripts')
<script src="{{asset('default/assets/demo/default/custom/components/datatables/base/data-local.js')}}" type="text/javascript"></script>
<script sec="{{asset('default/assets/jquery-3.4.0.min.js')}}"></script>
<script>
    function sendaccept(){
        console.log('clicked')
        var id = $('input[name=buffer]').val()
        console.log(id)
        var price = $('input[name=price]').val()
        console.log(price)
        var token = $('input[name="_token"]').val();
        if(price == ""){
            alert('You Should Enter the price ')
        } else {
            $.ajax({
                url:'/orders/action',
                method:'post',
                data:{
                    id:id,
                    _token:token,
                    action:'accept',
                    price:price
                },
                    success:function(response){
                        if(response != 'ok'){
                            $('#myModal4').show();
                            $('button').click(function(){
                            $('#myModal4').hide();
                            })
                        } else {
                            $('tr#'+id).remove()
                            $('#myModal3').show();
                            $('button').click(function(){
                            $('#myModal3').hide();
                            })
                        }

                }
            });
        }
    }
    function sendrefuse(){
            console.log('clicked')
            var id = $('input[name=buffer]').val()
            console.log(id)
            var comment = $('input[name=comment]').val()
            console.log(comment)
            var token = $('input[name="_token"]').val();
            $.ajax({
                url:'/orders/action',
                method:'post',
                data:{
                    id:id,
                    _token:token,
                    comment:comment,
                    action:'refuse'
                },
                success:function(response){
                    $('tr#'+id).remove();
                    $('#myModal5').show();
                    $('button').click(function(){
                        $('#myModal5').hide();
                    })
                }
            });
        }
    $(document).ready(function(){

        $('.accept').click(function(){

            var id = $(this).parent().parent().attr('id');
            var f = $('input[name=buffer]').val(id);
            console.log(f)
            /*var price = $(this).parent().parent().find('input[name=price]').val();
            if(price ==""){
                alert('You Should Enter The price ')
            } else {
                var token = $('input[name="_token"]').val();
                $.ajax({
                    url:'/orders/action',
                    method:'post',
                    data:{
                        id:id,
                        _token:token,
                        action:'accept',
                        price:price
                    },
                    success:function(response){
                        $('tr#'+id).remove()
                    }
                });
            }
*/
        });
        $('.refuse').click(function(){
            var id = $(this).parent().parent().attr('id');
            var f = $('input[name=buffer]').val(id);
            console.log(f)
            /*
            var token = $('input[name="_token"]').val();
            $.ajax({
                url:'/orders/action',
                method:'post',
                data:{
                    id:id,
                    _token:token,
                    action:'refuse'
                },
                success:function(response){
                    $('tr#'+id).remove()
                }
            });
            */
        });

    });
</script>
@endsection
