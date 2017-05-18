@extends('layout.merchant')

@section('isi')
    <div class="container-fluid">
      <div class="row">
                <div class="col-sm-12">
                  <div id="bordered">
                      <h3>Message</h3>
                        <hr />
                        @foreach($messages as $message)
                          <div class="row">
                              <div class="col-sm-6 messagebox">
                                    <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#message1">
                                        <div class="message">
                                            <img class="img-circle" src="img/test.jpg" width="50" height="50" /> User Name <span class="badge">5</span>
                                        </div>
                                    </button>
                                </div>  
                            </div>
                            <div class="modal fade" id="message1" align="left" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <img src="img/test.jpg" class="img-circle" width="50" height="50" /> User Name
                                        </div>
                                        <div class="modal-body">
                                          <div class="messagebody container-fluid">
                                              <div class="msgother row">
                                                  <div class="col-sm-2">
                                                      asdasdasdasd
                                                    </div>
                                                    <div class="col-sm-10">
                                                      <p>AAAAAAAAAAAAAAAAAAA</p>
                                                    </div>
                                                </div>
                                                <div class="msgme">
                                                  <div class="col-sm-10">
                                                    <p>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</p>
                                                    </div>
                                                    <div class="col-sm-2">
                                                      <img src="img/test.jpg" class="img-circle" width="50" height="50" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="submit row" style="padding-top:15px" align="right">
                                              <div class="col-sm-10">
                                                <textarea style="width:100%"></textarea>
                                                </div>
                                                <div class="col-sm-2">
                                                  <button class="btn btn-primary" type="submit">Kirim</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach         
                    </div>  
              </div>
           
        </div>
    </div>
@stop