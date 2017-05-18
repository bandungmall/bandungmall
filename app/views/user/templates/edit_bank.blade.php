
<!-- Modal Add address start -->
<form action="{{ URL::to('user/myAccount/editBank') }}" method="POST">
    <div class="modal signUpContent fade" id="ModalEditBank" tabindex="-1" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                    <h3 class="modal-title-site text-center"> Masukkan data Bank</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div>
                            <select class="form-control" name="bank_id_ganti" id="bank_id_ganti">
                                <option value="0">Pilih Bank</option>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}">{{$bank->singkatan}}</option>
                                @endforeach
                            </select>
                            <input name="id" id="nama_bank"  class="form-control input" type="text" disabled>
                            <input name="bank_id" id="bank_id" type="hidden">
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <input name="nama_acc" id="nama_acc" class="form-control input" size="20"
                                   placeholder="Nama Account bank" type="text" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <input name="nama_rek" id="nama_rek" class="form-control input" size="20"
                                   placeholder="Nama Rekening bank" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <input name="no_rek" id="no_rek" class="form-control input" size="20"
                                   placeholder="No Rekening bank" type="text">
                        </div>
                    </div>



                    <div >
                        <div>
                            <input name="id" id="id" type="hidden">
                            <button name="submit" class="btn  btn-block btn-lg btn-primary" value="" type="submit">Simpan Account Bank</button>
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