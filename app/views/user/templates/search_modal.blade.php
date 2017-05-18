<!-- Modal Signup start -->
<form role="form" action="{{URL::to('product/search/brand/')}}" method="get" id="formSearch">
    <div class="modal signUpContent fade" id="ModalSearch" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                    <h3 class="modal-title-site text-center"> SEARCH </h3>
                </div>
                <div class="modal-body">
                    <!-- <div class="control-group"><a class="fb_button btn  btn-block btn-lg " href="#"> SIGNUP WITH
                        FACEBOOK </a></div>
                    <h5 style="padding:10px 0 10px 0;" class="text-center"> OR </h5> -->

                    <div class="form-group">
                        <div>
                            <input name="search" class="form-control input" size="20" placeholder="Cari produk yang diinginkan" type="text">
                        </div>
                    </div>
                    <div>
                        <div>
                            <input class="btn  btn-block btn-lg btn-primary" value="CARI" type="submit">
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.modal-content -->

        </div>
        <!-- /.modal-dialog -->

    </div>
    <!-- /.ModalSignup End -->
</form>
