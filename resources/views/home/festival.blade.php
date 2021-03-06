@extends('layouts.default')

@section('content')
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ trans('lang.index_title') }}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="price-tab" data-toggle="tab" href="#price" role="tab" aria-controls="price" aria-selected="false">{{ trans('lang.price') }}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="legacy-facundo-tab" data-toggle="tab" href="#legacy-facundo" role="tab" aria-controls="legacy-facundo" aria-selected="false">{{ trans('lang.legacy') }} Facundo</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="legacy-gilberto-tab" data-toggle="tab" href="#legacy-gilberto" role="tab" aria-controls="legacy-gilberto" aria-selected="false">{{ trans('lang.legacy') }} Gilberto Gil</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  	{!! trans('lang.tab1') !!}
  </div>
  <div class="tab-pane fade" id="price" role="tabpanel" aria-labelledby="price-tab">...</div>
  <div class="tab-pane fade" id="legacy-facundo" role="tabpanel" aria-labelledby="legacy-facundo-tab">...</div>
  <div class="tab-pane fade" id="legacy-gilberto" role="tabpanel" aria-labelledby="legacy-gilberto-tab">...</div>
</div>
<div id="tabs-container">
    <div class="tab">
        <div id="tab-1" class="tab-content">
        </div>
        <div id="tab-2" class="tab-content">


        </div>
        <div id="tab-3" class="tab-content">
            <p>
              <div class="yt_holder">
                <div id="ytvideo2"></div>
                  <ul class="demo1">
                    <li><a href="https://www.youtube.com/watch?v=CHtrFNbm2Ys&list=RDCHtrFNbm2Ys#t=8">1. PENDEJOS</a></li>
                    <li><a href="https://www.youtube.com/watch?v=phhGGzH_GTA&list=RDphhGGzH_GTA">2. ESTE ES UN NUEVO DIA</a></li>
                    <li><a href="https://www.youtube.com/watch?v=xD3G6eM3tPI&index=2&list=RDphhGGzH_GTA">3. NO SOY DE AQUI NI SOY DE ALLA</a></li>
                    <li><a href="https://www.youtube.com/watch?v=93svO0gInhM&index=31&list=RDphhGGzH_GTA">4. VUELE BAJO</a></li>
                    <li><a href="https://www.youtube.com/watch?v=eWQNolrpj4c&list=RDeWQNolrpj4c">5. VENGO DE TODAS LAS COSAS</a></li>
                    <li><a href="https://www.youtube.com/watch?v=OiJgay4rw68&index=10&list=RDCHtrFNbm2Ys">6. POBRECITO MI PATRON</a></li>
                    <li><a href="https://www.youtube.com/watch?v=Yt_LS7VVXgY&index=17&list=RDphhGGzH_GTA">7. EL DIA QUE YO ME VAYA</a></li>
                    <li><a href="https://www.youtube.com/watch?v=5TxpWWkCnxA">8. NO ESTAS DEPRIMIDO ESTAS DISTRAIDO</a></li>
                  </ul>
              </div>

        <ul class="lb-album">
          <li>
            <a href="#image-1">
              <img src="../../../plugin/CSS3Lightbox/images/thumbs/i1.jpg" alt="FACUNDO CABRAL">
              <span>FACUNDO CABRAL</span>
            </a>
            <div class="lb-overlay" id="image-1">
              <img src="../../../plugin/CSS3Lightbox/images/full/i1.jpg" alt="FACUNDO CABRAL" />
              <div>
                <h3>FACUNDO CABRAL<span></h3>
                <p></p>
                <a href="#image-10" class="lb-prev">Prev</a>
                <a href="#image-2" class="lb-next">Next</a>
              </div>
              <a href="#page" class="lb-close">x Close</a>
            </div>
          </li>
          <li>
            <a href="#image-2">
              <img src="../../../plugin/CSS3Lightbox/images/thumbs/i2.jpg" alt="FACUNDO CABRAL">
              <span>FACUNDO CABRAL</span>
            </a>
            <div class="lb-overlay" id="image-2">
              <img src="../../../plugin/CSS3Lightbox/images/full/i2.jpg" alt="FACUNDO CABRAL" />
              <div>
                <h3>FACUNDO CABRAL<span></h3>
                <p></p>
                <a href="#image-1" class="lb-prev">Prev</a>
                <a href="#image-3" class="lb-next">Next</a>
              </div>
              <a href="#page" class="lb-close">x Close</a>
            </div>
          </li>
          <li>
            <a href="#image-3">
              <img src="../../../plugin/CSS3Lightbox/images/thumbs/i3.jpg" alt="FACUNDO CABRAL">
              <span>FACUNDO CABRAL</span>
            </a>
            <div class="lb-overlay" id="image-3">
              <img src="../../../plugin/CSS3Lightbox/images/full/i3.jpg" alt="FACUNDO CABRAL" />
              <div>
                <h3>FACUNDO CABRAL<span></h3>
                <p></p>
                <a href="#image-2" class="lb-prev">Prev</a>
                <a href="#image-4" class="lb-next">Next</a>
              </div>
              <a href="#page" class="lb-close">x Close</a>
            </div>
          </li>
          <li>
            <a href="#image-4">
              <img src="../../../plugin/CSS3Lightbox/images/thumbs/i4.jpg" alt="FACUNDO CABRAL">
              <span>FACUNDO CABRAL</span>
            </a>
            <div class="lb-overlay" id="image-4">
              <img src="../../../plugin/CSS3Lightbox/images/full/i4.jpg" alt="FACUNDO CABRAL" />
              <div>
                <h3>FACUNDO CABRAL<span></h3>
                <p></p>
                <a href="#image-3" class="lb-prev">Prev</a>
                <a href="#image-5" class="lb-next">Next</a>
              </div>
              <a href="#page" class="lb-close">x Close</a>
            </div>
          </li>
          <li>
            <a href="#image-5">
              <img src="../../../plugin/CSS3Lightbox/images/thumbs/i5.jpg" alt="FACUNDO CABRAL">
              <span>FACUNDO CABRAL</span>
            </a>
            <div class="lb-overlay" id="image-5">
              <img src="../../../plugin/CSS3Lightbox/images/full/i5.jpg" alt="FACUNDO CABRAL" />
              <div>
                <h3>FACUNDO CABRAL<span> </h3>
                <p> </p>
                <a href="#image-4" class="lb-prev">Prev</a>
                <a href="#image-6" class="lb-next">Next</a>
              </div>
              <a href="#page" class="lb-close">x Close</a>
            </div>
          </li>
          <li>
            <a href="#image-6">
              <img src="../../../plugin/CSS3Lightbox/images/thumbs/i6.jpg" alt="FACUNDO CABRAL">
              <span>FACUNDO CABRAL</span>
            </a>
            <div class="lb-overlay" id="image-6">
              <img src="../../../plugin/CSS3Lightbox/images/full/i6.jpg" alt="FACUNDO CABRAL" />
              <div>
                <h3>FACUNDO CABRAL<span> </h3>
                <p> </p>
                <a href="#image-5" class="lb-prev">Prev</a>
                <a href="#image-7" class="lb-next">Next</a>
              </div>
              <a href="#page" class="lb-close">x Close</a>
            </div>
          </li>
          <li>
            <a href="#image-7">
              <img src="../../../plugin/CSS3Lightbox/images/thumbs/i7.jpg" alt="FACUNDO CABRAL">
              <span>FACUNDO CABRAL</span>
            </a>
            <div class="lb-overlay" id="image-7">
              <img src="../../../plugin/CSS3Lightbox/images/full/i7.jpg" alt="FACUNDO CABRAL" />
              <div>
                <h3>FACUNDO CABRAL<span> </h3>
                <p> </p>
                <a href="#image-6" class="lb-prev">Prev</a>
                <a href="#image-8" class="lb-next">Next</a>
              </div>
              <a href="#page" class="lb-close">x Close</a>
            </div>
          </li>
          <li>
            <a href="#image-8">
              <img src="../../../plugin/CSS3Lightbox/images/thumbs/i8.jpg" alt="FACUNDO CABRAL">
              <span>FACUNDO CABRAL</span>
            </a>
            <div class="lb-overlay" id="image-8">
              <img src="../../../plugin/CSS3Lightbox/images/full/i8.jpg" alt="FACUNDO CABRAL" />
              <div>
                <h3>FACUNDO CABRAL<span></h3>
                <p></p>
                <a href="#image-7" class="lb-prev">Prev</a>
                <a href="#image-9" class="lb-next">Next</a>
              </div>
              <a href="#page" class="lb-close">x Close</a>
            </div>
          </li>
          <li>
            <a href="#image-9">
              <img src="../../../plugin/CSS3Lightbox/images/thumbs/i9.jpg" alt="FACUNDO CABRAL">
              <span>FACUNDO CABRAL</span>
            </a>
            <div class="lb-overlay" id="image-9">
              <img src="../../../plugin/CSS3Lightbox/images/full/i9.jpg" alt="FACUNDO CABRAL" />
              <div>
                <h3>FACUNDO CABRAL<span></h3>
                <p></p>
                <a href="#image-8" class="lb-prev">Prev</a>
                <a href="#image-10" class="lb-next">Next</a>
              </div>
              <a href="#page" class="lb-close">x Close</a>
            </div>
          </li>
          <li>
            <a href="#image-10">
              <img src="../../../plugin/CSS3Lightbox/images/thumbs/i10.jpg" alt="FACUNDO CABRAL">
              <span>FACUNDO CABRAL</span>
            </a>
            <div class="lb-overlay" id="image-10">
              <img src="../../../plugin/CSS3Lightbox/images/full/i10.jpg" alt="FACUNDO CABRAL" />
              <div>
                <h3>FACUNDO CABRAL<span></h3>
                <p></p>
                <a href="#image-9" class="lb-prev">Prev</a>
                <a href="#image-1" class="lb-next">Next</a>
              </div>
              <a href="#page" class="lb-close">x Close</a>
            </div>
          </li>
        </ul>
            </p>
        </div>


        <div id="tab-4" class="tab-content">
            <p>
              <div class="yt_holder">
                <div id="ytvideo3"></div>
                  <ul class="demo2">
                    <li><a href="https://www.youtube.com/watch?v=QxWfINzbIac">1. A Paz</a></li>
                    <li><a href="https://www.youtube.com/watch?v=a-Td2WQrFjk">2. Não Chores Mais</a></li>
                    <li><a href="https://www.youtube.com/watch?v=VqVwY5PJNGw">3. Estrela</a></li>
                    <li><a href="https://www.youtube.com/watch?v=cw2htOGZO1Q">4. Se Eu Quiser Falar Com Deus</a></li>
                    <li><a href="https://www.youtube.com/watch?v=CTJdrLuNVzQ">5. Tempo Rei</a></li>
                    <li><a href="https://www.youtube.com/watch?v=-YAQ8fYqtfw">6. DRÃO</a></li>
                    <li><a href="https://www.youtube.com/watch?v=Yt_LS7VVXgY&index=17&list=RDphhGGzH_GTA">7. EL DIA QUE YO ME VAYA</a></li>
                    <li><a href="https://www.youtube.com/watch?v=5TxpWWkCnxA">8. NO ESTAS DEPRIMIDO ESTAS DISTRAIDO</a></li>
                  </ul>
              </div>
              <ul class="lb-album">
                <li>
                  <a href="#imagen-1">
                    <img src="../../../plugin/CSS3Lightbox/images/thumbs/g1.jpg" alt="FACUNDO CABRAL">
                    <span>Gilberto Gil</span>
                  </a>
                  <div class="lb-overlay" id="imagen-1">
                    <img src="../../../plugin/CSS3Lightbox/images/full/g1.jpg" alt="FACUNDO CABRAL" />
                    <div>
                      <h3>Gilberto Gil<span></h3>
                      <p></p>
                      <a href="#imagen-4" class="lb-prev">Prev</a>
                      <a href="#imagen-2" class="lb-next">Next</a>
                    </div>
                    <a href="#page" class="lb-close">x Close</a>
                  </div>
                </li>
                <li>
                  <a href="#imagen-2">
                    <img src="../../../plugin/CSS3Lightbox/images/thumbs/g2.jpg" alt="FACUNDO CABRAL">
                    <span>Gilberto Gil</span>
                  </a>
                  <div class="lb-overlay" id="imagen-2">
                    <img src="../../../plugin/CSS3Lightbox/images/full/g2.jpg" alt="FACUNDO CABRAL" />
                    <div>
                      <h3>Gilberto Gil<span></h3>
                      <p></p>
                      <a href="#imagen-1" class="lb-prev">Prev</a>
                      <a href="#imagen-3" class="lb-next">Next</a>
                    </div>
                    <a href="#page" class="lb-close">x Close</a>
                  </div>
                </li>
                <li>
                  <a href="#imagen-3">
                    <img src="../../../plugin/CSS3Lightbox/images/thumbs/g3.jpg" alt="FACUNDO CABRAL">
                    <span>Gilberto Gil</span>
                  </a>
                  <div class="lb-overlay" id="imagen-3">
                    <img src="../../../plugin/CSS3Lightbox/images/full/g3.jpg" alt="FACUNDO CABRAL" />
                    <div>
                      <h3>Gilberto Gil<span></h3>
                      <p></p>
                      <a href="#imagen-2" class="lb-prev">Prev</a>
                      <a href="#imagen-4" class="lb-next">Next</a>
                    </div>
                    <a href="#page" class="lb-close">x Close</a>
                  </div>
                </li>
                <li>
                  <a href="#imagen-4">
                    <img src="../../../plugin/CSS3Lightbox/images/thumbs/g4.jpg" alt="FACUNDO CABRAL">
                    <span>Gilberto Gil</span>
                  </a>
                  <div class="lb-overlay" id="imagen-4">
                    <img src="../../../plugin/CSS3Lightbox/images/full/g4.jpeg" alt="FACUNDO CABRAL" />
                    <div>
                      <h3>Gilberto Gil<span></h3>
                      <p></p>
                      <a href="#imagen-3" class="lb-prev">Prev</a>
                      <a href="#imagen-1" class="lb-next">Next</a>
                    </div>
                    <a href="#page" class="lb-close">x Close</a>
                  </div>
                </li>

              </ul>
            </p>
        </div>

    </div>
</div>
@stop