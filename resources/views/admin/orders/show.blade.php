@extends('admin/layouts.master')
@section('title','Dashboard')
@section('pageTitle','Dashboard')

@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Orders
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
                <a href="@if(Auth::user()->role_id == 2) {{route('hospital/orders')}} @else {{route('orders/pending')}} @endif" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Orders
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                    <a href="{{route('orders.show',$order->id)}}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Order Information
                            </span>
                        </a>
                    </li>
            </ul>
        </div>
    </div>
</div>
<div class="m-portlet m-portlet--tab">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Order Information
                    </h3>
                </div>
            </div>
        </div>

      <div class="m-portlet__body col-md-12">
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-md-6"><p> Hospital Name: {{$hospital->name}}</p></div>
                        <div class="col-md-6"><p> Hospital Address: {{$hospital->address}}</p></div>
                    </div>
                    <div class="row">
                            <div class="col-md-6"><p> Blood Type: @switch($order->blood_type)
                                @case(1) {{"O+"}} @break
                                @case(2) {{"O-"}} @break
                                @case(3) {{"A+"}} @break
                                @case(4) {{"A-"}} @break
                                @case(5) {{"B+"}} @break
                                @case(6) {{"B-"}} @break
                                @case(7) {{"AB+"}} @break
                                @case(8) {{"AB-"}} @break
                                @endswitch</p></div>
                            <div class="col-md-6"><p> Amount: {{$order->amount}}</p></div>
                    </div>
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-md-6"><p> Order Status : @switch($order->status)
                            @case(1) <span class="m-badge m-badge--brand m-badge--wide">Pending</span> @break
                            @case(2) <span class="m-badge  m-badge--success m-badge--wide">Accepted</span> @break
                            @case(3) <span class="m-badge  m-badge--danger m-badge--wide">Refused</span> @break
                            @endswitch</p>
                        </div>
                        @if($order->status == 2 && Auth::user()->hospital_id == $order->hospital_id)
                        <div class="col-md-6"><p> Price: {{$order->price}} </p></div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6"><button type="button" class="btn btn-secondary active m-btn m-btn--custom">
                            Follow Order
                        </button>*(Future Plan)</div>
                    </div>
                    @if(Auth::user()->hospital_id == $order->to_id)
                    <div class="row" id="to_del" style="margin-top:15px;width:100%;">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><center>
                            <button type="button" class="btn btn-success accept" data-toggle="modal" data-target="#myModal" style="margin-right:5px;margin-left:5px;">Accept</button> <button type="button" class="btn btn-danger refuse" style="margin-right:5px;margin-left:5px;" data-toggle="modal" data-target="#myModal2">Refuse</button></center>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    @endif
                <input type="hidden" name="order_id" value="{{$order->id}}">
            </div>
    </div>
    <input type="hidden" name="buffer">
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
                    <input type="number" class="form-control m-input" id="{{$order->id}}" placeholder="Enter Price" name="price">
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
                    <input type="text" class="form-control m-input" id="{{$order->id}}" placeholder="Enter Your Comment" name="comment">
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
<script sec="{{asset('default/assets/jquery-3.4.0.min.js')}}"></script>
<script>
    function sendaccept(){
        console.log('clicked')
        var id = $('input[name=order_id]').val()
        console.log(id)
        var price = $('input[name=price]').val()
        console.log(price)
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
                    if(response != 'ok'){
                            $('#myModal3').show();
                            $('button').click(function(){
                            $('#myModal3').hide();
                            })
                        } else {
                            $('#to_del').remove()
                            $('#myModal3').show();
                            $('button').click(function(){
                            $('#myModal3').hide();
                            })
                        }

            }
        });
    }
    function sendrefuse(){
            console.log('clicked')
            var id = $('input[name=order_id]').val()
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
                    $('#to_del').remove()
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
                    $(this).parent().remove()
                }
            });
            */
        });

    });

</script>
@endsection
