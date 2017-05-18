          <!--======= SIDE BAR =========-->
          <div class="col-sm-3 animate fadeInLeft" data-wow-delay="0.2s">
            <div class="side-bar">
              <h4>Filter by</h4>

              <!-- HEADING -->
              <div class="heading">
                <h6>CATEGORIES</h6>
              </div>
              
              <!-- CATEGORIES -->
              <ul class="cate" style="text-transform: capitalize;">
              <?php 
                $arr = array('anak-anak','home & living');
              ?>
               @foreach ($category_root as $root)
                  @if(!in_array($root->name, $arr))
                  <li class="drop-menu"><a class="title collapsed" data-toggle="collapse" data-target="#category-r{{ $root->id }}"> {{ $root->name }} </a>
                    <div class="collapse" id="category-r{{ $root->id }}">
                      <div class="well">
                        <ul>
                        @foreach ($category_parent as $parent)
                          @if ($parent->id_root === $root->id)
                            <li class="drop-menu"><a class="title collapsed" data-toggle="collapse" data-target="#category-p{{ $parent->id }}">{{ $parent->name }}</a>
                              <div class="collapse" id="category-p{{ $parent->id }}">
                                <div class="well">
                                  <ul>
                                  @foreach ($category_child as $child)
                                    @if ($child->id_parent === $parent->id)
                                      <li class="drop-menu"><a <?php echo $child->has_grand_child == "yes" ? "class='title collapsed' data-toggle='collapse' data-target='#category-c$child->id'": "href='product/c-$child->id'" ;?>>{{ $child->name }}</a></li>
                                        @if($child->has_grand_child == "yes")
                                          <div class="collapse" id="category-c{{ $child->id }}">
                                            <div class="well">
                                              <ul>
                                              @foreach ($category_grand_child as $grand_child)
                                                @if ($grand_child->id_child === $child->id)
                                                  <li class="drop-menu"><a href="product/gc-{{$grand_child->id}}">{{ $grand_child->name }}</a>
                                                @endif
                                              @endforeach
                                              </ul>
                                            </div>
                                          </div>
                                        @endif
                                    @endif
                                  @endforeach
                                  </ul>
                                </div>
                              </div>
                            </li>
                          @endif
                        @endforeach
                        </ul>
                      </div>
                    </div>
                  </li>
                  @endif
                @endforeach
              </ul>

              <!-- HEADING -->
              <div class="heading">
                <h6>COLOR</h6>
              </div>
              
              <!-- COLORE -->
              <ul class="cate">
                <li>
                  <a href="{{ URL::to('product/search/colour/c_hitam') }}">
                    <small style="background-color:#333333;padding:2px 9px;margin-right:8px;border-radius:20px"></small>
                    Hitam
                  </a>
                </li>
                <li>
                  <a href="{{ URL::to('product/search/colour/c_biru') }}">
                    <small style="background-color:#1664c4;padding:2px 9px;margin-right:8px;border-radius:20px"></small>
                    Biru
                  </a>
                </li>
                <li>
                  <a href="{{ URL::to('product/search/colour/c_merah') }}">
                    <small style="background-color:#c00707;padding:2px 9px;margin-right:8px;border-radius:20px"></small>
                    Merah
                  </a>
                </li>
                <li>
                  <a href="{{ URL::to('product/search/colour/c_hijau') }}">
                    <small style="background-color:#6fcc14;padding:2px 9px;margin-right:8px;border-radius:20px"></small>
                    Hijau
                  </a>
                </li>
                <li>
                  <a href="{{ URL::to('product/search/colour/c_coklat') }}">
                    <small style="background-color:#943f00;padding:2px 9px;margin-right:8px;border-radius:20px"></small>
                    Coklat
                  </a>
                </li>
                <li>
                  <a href="{{ URL::to('product/search/colour/c_pink') }}">
                    <small style="background-color:#ff1cae;padding:2px 9px;margin-right:8px;border-radius:20px"></small>
                    Pink
                  </a>
                </li>
                <li>
                  <a href="{{ URL::to('product/search/colour/c_abu') }}">
                    <small style="background-color:#adadad;padding:2px 9px;margin-right:8px;border-radius:20px"></small>
                    Abu
                  </a>
                </li>
                <li>
                  <a href="{{ URL::to('product/search/colour/c_ungu') }}">
                    <small style="background-color:#5d00dc;padding:2px 9px;margin-right:8px;border-radius:20px"></small>
                    Ungu
                  </a>
                </li>
                <li>
                  <a href="{{ URL::to('product/search/colour/c_kuning') }}">
                    <small style="background-color:#f1f40e;padding:2px 9px;margin-right:8px;border-radius:20px"></small>
                    Kuning
                  </a>
                </li>
                <li>
                  <a href="{{ URL::to('product/search/colour/c_orange') }}">
                    <small style="background-color:#ffc600;padding:2px 9px;margin-right:8px;border-radius:20px"></small>
                    Orange
                  </a>
                </li>
                <li>
                  <a href="{{ URL::to('product/search/colour/c_silve') }}">
                    <small style="background-color:#ecf1ef;padding:2px 9px;margin-right:8px;border-radius:20px"></small>
                    Silver
                  </a>
                </li>
                <li>
                  <a href="{{ URL::to('product/search/colour/c_putih') }}">
                    <small style="background-color:#f3f1e7;padding:2px 9px;margin-right:8px;border-radius:20px"></small>
                    Putih
                  </a>
                </li>
              </ul>

              <!-- HEADING -->
              <div class="heading">
                <h6>PRICE</h6>
              </div>
              <!-- PRICE -->
              <div>
                <a href="{{ URL::to('product/search/price/p_asc') }}" class="btn btn-small btn-dark" >FILTER FROM LOWEST</a>
                <a href="{{ URL::to('product/search/price/p_desc') }}" class="btn btn-small btn-dark" >FILTER FROM HIGHEST</a> 
              </div>

              <!-- HEADING -->
              <div class="heading">
                <h6>DATE</h6>
              </div>
              <!-- DATE -->
              <div>
                <a href="{{ URL::to('product/search/date/d_desc') }}" class="btn btn-small btn-dark" >FILTER FROM NEWEST</a>
                <a href="{{ URL::to('product/search/date/d_asc') }}" class="btn btn-small btn-dark" >FILTER FROM OLDEST</a> 
              </div>

              <!-- HEADING -->
              <div class="heading">
                <h6>SALE</h6>
              </div>
              <!-- SALE -->
              <div>
                <a href="{{ URL::to('product/search/sale/s_desc') }}" class="btn btn-small btn-dark" >FILTER FROM BIGEST</a>
                <a href="{{ URL::to('product/search/sale/s_asc') }}" class="btn btn-small btn-dark" >FILTER FROM SMALLEST</a> 
              </div>

            </div>
          </div>