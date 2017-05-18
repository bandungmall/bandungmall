
<!-- Modal Add address start -->
<form action="{{ URL::to('user/myAccount/editAddress') }}" method="POST">
    <div class="modal signUpContent fade" id="ModalEditAddress" tabindex="-1" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                    <h3 class="modal-title-site text-center"> Masukkan data alamat</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div>
                            <input type="hidden" name="address_id" id="address_id">
                            <input name="name" id="name" class="form-control input" size="20" value=""
                                   placeholder="Nama Tempat (Rumah,Kantor)" type="text">
                        </div>
                    </div>

                    <div class="form-group login-username">
                        <div>
                            <input name="district" id="district" class="form-control input" size="20" value=""
                                   placeholder="Provinsi" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <select class="form-control" id="citySelector" onchange="run()">
                                <option value="0" selected>Kota</option>
                                @foreach($areas as $area)
                                    <option value="{{$area->area_name}}">{{$area->area_name}}</option>
                                @endforeach
                            </select>
                            <input name="city" id="city" type="hidden">
                        </div>
                    </div>

                    <div class="form-group login-username">
                        <div>
                            <input name="address" id="address" class="form-control input" size="20" value=""
                                   placeholder="Alamat" type="text">
                        </div>
                    </div>

                    <div class="form-group login-username">
                        <div>
                            <input name="postal_code" id="postal_code" class="form-control input" size="20" value=""
                                   placeholder="Kode Pos" type="text">
                        </div>
                    </div>

                    <div class="form-group login-username">
                        <div>
                            <input name="phone_number" id="phone_number" class="form-control input" size="20" value=""
                                   placeholder="No Telp" type="text">
                        </div>
                    </div>



                    <div >
                        <div>
                            <button name="submit" class="btn  btn-block btn-lg btn-primary" value="" type="submit">Simpan Alamat</button>
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

<script type="text/javascript">
function run() {
    document.getElementById("city").value = document.getElementById("citySelector").value;
}
</script>