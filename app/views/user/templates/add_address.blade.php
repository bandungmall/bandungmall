
<!-- Modal Add address start -->
<form action="{{ URL::to('user/myAccount/doAddAddress') }}" method="POST">
    <div class="modal signUpContent fade" id="ModalAddress" tabindex="-1" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                    <h3 class="modal-title-site text-center"> Masukkan data alamat</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div>
                            <input name="name" id="name" class="form-control input" size="20"
                                   placeholder="Nama Tempat (Rumah,Kantor)" type="text">
                        </div>
                    </div>

                    <div class="form-group login-username">
                        <div>
                            <select class="form-control" name="district" id="provinsi">
                                <option value="0" selected>Pilih Provinsi</option>
                                @foreach($areas_provinsi as $area)
                                    <option data-id="{{$area->id}}" value="{{$area->name}}">{{$area->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <select class="form-control" name="city" id="kota">
                                <option value="0" selected>Pilih Kota</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group login-username">
                        <div>
                            <input name="address" id="address" class="form-control input" size="20"
                                   placeholder="Alamat" type="text">
                        </div>
                    </div>

                    <div class="form-group login-username">
                        <div>
                            <input name="postal_code" id="postal_code" class="form-control input" size="20"
                                   placeholder="Kode Pos" type="text">
                        </div>
                    </div>

                    <div class="form-group login-username">
                        <div>
                            <input name="phone_number" id="phone_number" class="form-control input" size="20"
                                   placeholder="No Telp" type="text">
                        </div>
                    </div>



                    <div >
                        <div>
                            <button name="submit" class="btn  btn-block btn-lg btn-primary" value="" type="submit">Tambah Alamat</button>
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
