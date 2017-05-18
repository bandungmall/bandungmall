
<!-- Modal Add address start -->
<form action="{{ URL::to('user/myAccount/doAddBank') }}" method="POST">
    <div class="modal signUpContent fade" id="ModalBank" tabindex="-1" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                    <h3 class="modal-title-site text-center"> Masukkan data bank</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div>
                            <select class="form-control" name="bank_id" id="bank_id">
                                <option value="0">Pilih Bank</option>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}">{{$bank->singkatan}}</option>
                                @endforeach
                            </select>
                            <!-- <input name="bank_id" id="bank_id" type="hidden"> -->
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <input name="nama_acc" id="nama_rek" class="form-control input" size="20"
                                   placeholder="Nama Account bank" type="text" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <input name="nama_rek" id="nama_rek" class="form-control input" size="20"
                                   placeholder="Nama Rekening bank" type="text" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <input name="no_rek" id="no_rek" class="form-control input" size="20"
                                   placeholder="No Rekening bank" type="text" required>
                        </div>
                    </div>

                    <div >
                        <div>
                            <button name="submit" class="btn  btn-block btn-lg btn-primary" value="" type="submit">Tambah Account Bank</button>
                        </div>
                    </div>
                    <!--userForm-->

                </div>
                <div class="modal-footer">
                    <p class="text-center"> Pertama kali ke sini? <a data-toggle="modal" data-dismiss="modal"
                                                                href="#ModalSignup"> Sign Up. </a> <br>
                        <a href="{{ URL::to('user/forgotPassword') }}"> Lupa password? </a></p>
                </div>
            </div>
            <!-- /.modal-content -->

        </div>
        <!-- /.modal-dialog -->

    </div>
    <!-- /.Modal Login -->
</form>