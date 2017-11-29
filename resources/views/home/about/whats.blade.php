@extends('layouts.default')

@section('content')
  <div class="fh5co-hero">
    <div class="fh5co-overlay overly"></div>
    <div class="fh5co-cover text-center" data-stellar-background-ratio="0.5" style="background-image: url({{ asset('images/about.jpg') }});">
      <div class="desc animate-box">
        <h2>{{ trans('lang.about_title1') }}</h2>
      </div>
    </div>

  </div>
    
  <div id="fh5co-feature-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center heading-section position-relative">
          <h3></h3>
          <p class="text-justify">{!! trans('lang.about_text1') !!}</p>
        </div>
      </div>
    </div>
  </div>

    
  <div id="fh5co-portfolio" class="fh5co-section-gray">
    <div class="container">
      <div class="row text-section">
        <div class="d-block mx-auto heading-section animate-box position-relative">
          <h3 class="">{{ trans('lang.about_title2') }}</h3>
        </div>
        <p class="text-justify animate-box">{!! trans('lang.about_text2',[
        'link' => trans('lang.about_link')]) !!}</p>
      </div>
    </div>
  </div>
  <div id="fh5co-feature-ppp">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center position-relative">
          <p class="text-justify">{!! trans('lang.about_text3') !!}</p>
          <ol class="text-justify">
            {!! trans('lang.about_text4') !!}
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div id="fh5co-content-section">
    <div class="container">
      <div class="row text-section">
        <div class="d-block mx-auto heading-section animate-box position-relative">
          <h3 class="text-center">{{ trans('lang.mision') }}</h3>
          <small class="text-muted text-center">{{ trans('lang.mision_subtext') }}</small>
        </div>
        <p class="text-justify animate-box">{!! trans('lang.mision_text1') !!}</p>
      </div>
    </div>
  </div>
    
  <div id="fh5co-content-section" class="fh5co-section-gray">
    <div class="container">
      <div class="row">
        <div class="d-block mx-auto heading-section animate-box position-relative">
          <h3 class="text-center">{{ trans('lang.team') }}</h3>
        </div>
      </div>
    </div>
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-4">
            <div class="fh5co-team text-center animate-box">
              <figure>
                <img src="{{ asset('images/team/enoetexier_URI.png') }}" alt="Dra. Enoé Texier">
              </figure>
              <div class="description">
                <h3>Dra. Enoé Texier</h3>
                <p><span>{{ trans('lang.team_lang1') }}</span></p>
                <p>  <!--Coordenadora Regionais / :-->
                <br>
                <i class="fa fa-phone"></i> +58 212 638 8180 / +58 414 0200 736
                <a href="mailto:etexier@uri.org">etexier@uri.org</a>
                </p>
              </div>
              
              <p class="fh5co-social-icons">
                <a href="#"><i class="icon-twitter2"></i></a>
                <a href="#"><i class="icon-linkedin2"></i></a>
                <a href="#"><i class="icon-facebook3"></i></a>
              </p>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="fh5co-team text-center animate-box">
              <figure>
                <img src="{{ asset('images/team/saletteAquino_80x80.jpg') }}" alt="Salette Aquino">
              </figure>
              <div class="description">
                <h3>Salette Aquino.</h3>
                <p><span>{{ trans('lang.team_lang2') }}</span></p><!--/ Conselheiros Globais / -->
                <p>
                <br>
                - Campinas, Brasil -
                <br>
                <a href="mailto:salette.aquino@gmail.com">salette.aquino@gmail.com</a>
                </p>
              </div>
              <p class="fh5co-social-icons">
                <a href="#"><i class="icon-twitter2"></i></a>
                <a href="#"><i class="icon-linkedin2"></i></a>
                <a href="#"><i class="icon-facebook3"></i></a>
              </p>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="fh5co-team text-center animate-box">
              <figure>
                <img src="{{ asset('images/team/SofiaPainiqueo_80x80.jpg') }}" alt="Sofía Painiqueo.">
              </figure>
              <div class="description">
                <h3>Sofía Painiqueo.</h3>
                <p><span>{{ trans('lang.team_lang2') }}</span></p>
                <p>
                  <br>
                  - Temuco, Chile -
                  <br>
                  <a href="mailto:wirhinsofi@gmail.com">wirhinsofi@gmail.com</a>
                </p>
              </div>
              <p class="fh5co-social-icons">
                <a href="#"><i class="icon-twitter2"></i></a>
                <a href="#"><i class="icon-linkedin2"></i></a>
                <a href="#"><i class="icon-facebook3"></i></a>
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 mb-4">
            <div class="fh5co-team text-center animate-box">
              <figure>
                <img src="{{ asset('images/team/David_Limo_80x80.jpg') }}" alt="Rev. David Limo.">
              </figure>
              <div class="description">
                <h3>Rev. David Limo.</h3>
                <p><span>{{ trans('lang.team_lang2') }}</span></p>
                <p>
                  <br>
                  - Lima, Perú -
                  <br>
                  <a href="mailto:davidlimopajar@hotmail.com">davidlimopajar@hotmail.com</a>
                </p>
              </div>
              <p class="fh5co-social-icons">
                <a href="#"><i class="icon-twitter2"></i></a>
                <a href="#"><i class="icon-linkedin2"></i></a>
                <a href="#"><i class="icon-facebook3"></i></a>
              </p>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <div class="fh5co-team text-center animate-box">
              <figure>
                <img src="{{ asset('images/team/adriana_URI.jpg') }}" alt="Antrop. Adriana Reyes">
              </figure>
              <div class="description">
                <h3>Antrop. Adriana Reyes.</h3>
                <p><span>{{ trans('lang.team_lang3') }}</span></p>
                <!--/ Assistente Regionais / :-->
                <p>
                  <br>
                  <i class="fa fa-phone"></i> +58 212 638 81 80
                  <br>
                  <a href="mailto:chikistody@gmail.com">chikistody@gmail.com</a>
                </p>
              </div>
              <p class="fh5co-social-icons">
                <a href="#"><i class="icon-twitter2"></i></a>
                <a href="#"><i class="icon-linkedin2"></i></a>
                <a href="#"><i class="icon-facebook3"></i></a>
              </p>
            </div>

          </div>
          <div class="col-md-4 mb-4">
            <div class="fh5co-team text-center animate-box">
              <figure>
                <img src="{{ asset('images/team/deividgomes.jpg') }}" alt="Lic. Deivid Gomes Da Silva.">
              </figure>
              <div class="description">
                <h3>Lic. Deivid Gomes Da Silva.</h3>
                <p><span>{{ trans('lang.team_lang4') }}:</span></p>
                <p>
                  <br>
                  <i class="fa fa-phone"></i> +55 62 3432-9298 / +55 62 8165-7769
                  <br>
                  <a href="mailto: deividpsi@gmail.com"> deividpsi@gmail.com</a>
                </p>
              </div>
              <p class="fh5co-social-icons">
                <a href="#"><i class="icon-twitter2"></i></a>
                <a href="#"><i class="icon-linkedin2"></i></a>
                <a href="#"><i class="icon-facebook3"></i></a>
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 d-block mx-auto mb-4">
            <div class="fh5co-team text-center animate-box">
              <figure>
                <img src="{{ asset('images/team/Maria_eugenia_URI.jpg') }}" alt="Prof. María Eugenia Crespo de Mafia">
              </figure>
              <div class="description">
                <h3>Prof. María Eugenia Crespo de Mafia</h3>
                <p><span>{{ trans('lang.team_lang5') }}</span></p>
                <!--/  / CC Diálogo, Argentina:-->
                <p>
                  <br>
                  - Buenos Aires, Argentina -
                  <br>
                  <a href="mailto:mcrespo@uri.org">mcrespo@uri.org</a>
                </p>
              </div>
              <p class="fh5co-social-icons">
                <a href="#"><i class="icon-twitter2"></i></a>
                <a href="#"><i class="icon-linkedin2"></i></a>
                <a href="#"><i class="icon-facebook3"></i></a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- fh5co-content-section -->
@stop
