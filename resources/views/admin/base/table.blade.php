@extends('Dashboard::layouts.master')

@section('content')
    <div class="m-portlet m-portlet--mobile">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        @yield('tableTitle')
                    </h3>
                </div>
            </div>

        </div>


        <div class="m-portlet__body">
            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-md-4">
                                <div class="m-input-icon m-input-icon--left">
                                    <input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="generalSearch">
                                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                        <span>
                                            <i class="la la-search"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                        <a href="@yield('tableButtonAction')" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                            <span>
                                <span>
                                    @yield('tableButton')
                                </span>
                            </span>
                        </a>
                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                    </div>
                </div>
                @yield('afterSearch')

            </div>
            <!--begin: Datatable -->
            <div id="m_table_1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="m-datatable @yield('tableClass')" id="html_table" width="100%">
                            @yield('table')
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Deletion</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are You Sure To Delete This?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="deleteConfirm">Delete</button>
                </div>
            </div>

        </div>
    </div>

    <form id="delete_form" action="" method="POST" style="display: none;">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="DELETE">
    </form>
@endsection

@section('scripts')
    <script>
        $(function () {

            tableHtml = $('#html_table').mDatatable({
                data: {
                    saveState: {cookie: false},
                },
                search: {
                    input: $('#generalSearch'),
                },
                deferRender: true,
            });
        })

        $('.deleteAction').click(function (e) {
            e.preventDefault();
            $('#deleteConfirm').attr('data-id', $(this).data('id'));
        });

        function showModal(element)
        {
            $('#deleteConfirm').attr('data-href', element.getAttribute('data-href'));
        }

        $('#deleteConfirm').click(function (e) {
            e.preventDefault();
            $('#deleteConfirm').attr('disabled','disabled');
            $('#deleteConfirm').value='Deleting…';

            $('#delete-form-modal').modal('hide');
            $('#delete_form').attr('action',$('#deleteConfirm').data('href'));

            $('#delete_form').submit();
        });
    </script>


@endsection