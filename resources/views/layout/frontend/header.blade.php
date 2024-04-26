@isset($tool)

    <div class="bg_colors">

        <div></div>

        <div></div>

        <div></div>

        <div></div>

        <div></div>

        <div></div>

    </div>

@endisset

<header>

    <div class="container">

        <div class="header_container">

            <div class="logo_dropdown">

                <div class="logo">

                    <a href="{{ route('home') }}">

                        <img src="{{ asset('web_assets/frontend/extras/logo/flipacoin_logo.svg') }}"

                            alt="flip a coin logo" /></a>

                </div>

                <div class="languages_dropdown first">

                    <button class="languages_dropdown_btn">

                        English <i class="icon icon-arrow-down icon-lg icon-white"></i>

                    </button>

                    <ul class="languages_list">
                          @if (isset($links) && count($links) > 0)
                              
                          @foreach ($links as $item)
  
                              {{-- {{$item}} --}}
  
                              @if ($item->is_home)
  
                                  @if ($item->lang = config('contants.native_language'))
  
                                      <a href="{{ route('home') }}" />
  
                                          {{ Str::upper($item->lang) }}
  
                                      </a>   
  
                                  @else
  
                                  <a href="{{ route('native_language_tool',['slug' => $item->slug]) }}" />
  
                                      {{ Str::upper($item->lang) }}
  
                                  </a>  
  
                                  @endif
  
                              @else 
  
                          
  
                              <li>
  
                                  <a href="{{ route('other_language_tool', ['lang'=> $item->lang , 'slug' => $item->slug]) }}" />
  
                                      {{ Str::upper($item->lang) }}
  
                                  </a>
  
                              </li>
  
                              @endif  
  
                          @endforeach
                          
                          @endif

                    </ul>

                    {{-- <ul class="languages_list">

                        <li>

                            <a rel="alternate" hreflang="en" class="selected_language" href="http://127.0.0.1:8000">

                                English - <span class="text_upper">en</span>

                            </a>

                        </li>

                        <li>

                            <a rel="alternate" hreflang="fr" class="" href="http://127.0.0.1:8000/fr/flip-a-coin-francais">

                                français - <span class="text_upper">fr</span>

                            </a>

                        </li>

                        <li>

                            <a rel="alternate" hreflang="de" class="" href="http://127.0.0.1:8000/de/flip-a-coin-deutshe">

                                Deutsch - <span class="text_upper">de</span>

                            </a>

                        </li>

                        <li>

                            <a rel="alternate" hreflang="it" class="" href="http://127.0.0.1:8000/it/flip-a-coin-italiano">

                                italiano - <span class="text_upper">it</span>

                            </a>

                        </li>

                        <li>

                            <a rel="alternate" hreflang="pl" class="" href="http://127.0.0.1:8000/pl/flip-a-coin-polsih">

                                polski - <span class="text_upper">pl</span>

                            </a>

                        </li>

                        <li>

                            <a rel="alternate" hreflang="pt" class="" href="http://127.0.0.1:8000/br/flip-a-coin-portugu%C3%AAs">

                                português - <span class="text_upper">pt</span>

                            </a>

                        </li>

                        <li>

                            <a rel="alternate" hreflang="ru" class="" href="http://127.0.0.1:8000/ru/flip-a-coin-%D1%80%D1%83%D1%81%D1%81%D0%BA%D0%B8%D0%B9">

                                русский - <span class="text_upper">ru</span>

                            </a>

                        </li>

                        <li>

                            <a rel="alternate" hreflang="es" class="" href="http://127.0.0.1:8000/es/flip-a-coin-spanish">

                                español - <span class="text_upper">es</span>

                            </a>

                        </li>

                    </ul> --}}

                </div>

            </div>

            <div class="other_games">

                <a href="{{ route('native_language_tool', ['slug' => 'roll-a-dice']) }}" class="game">

                <i class="game_icon icon-colored icon-dice icon-3x"></i>

                <h3 class="game_name">Roll a die</h3>

                </a>

                <a href="{{ route('native_language_tool', ['slug' => '2048']) }}" class="game">

                <i class="game_icon icon-colored icon-2048 icon-3x"></i>

                <h3 class="game_name">2048 game</h3>

                </a>

                <a href="{{ route('home')}}" class="game">

                <i class="game_icon icon-colored icon-flip-coin icon-3x"></i>

                <h3 class="game_name">Coin flip</h3>

                </a>

            </div>

            <div class="languages_dropdown second">

                <button class="languages_dropdown_btn text_capitalize">

                    English <i class="icon icon-arrow-down icon-lg icon-white"></i>

                </button>

          

                <ul class="languages_list">

                    @if (isset($links) && count($links) >0)
                        
                    @foreach ($links as $item)

                        {{-- {{$item}} --}}

                        @if ($item->is_home)

                            @if ($item->lang = config('contants.native_language'))

                                <a href="{{ route('home') }}" />

                                    {{ Str::upper($item->lang) }}

                                </a>   

                            @else

                            <a href="{{ route('native_language_tool',['slug' => $item->slug]) }}" />

                                {{ Str::upper($item->lang) }}

                            </a>  

                            @endif

                        @else 
                        @php

                        $lang_name = array(

                            'en' => 'English -',

                            'fr' => 'Français -',

                            'de' => 'Deutsch -',

                            'it' => 'Italiano -',

                            'pl' => 'Polski -',

                            'br' => 'Português -',

                            'ru' => 'Pусский -',

                            'es' => 'Español -'

                        );

                        @endphp

                        @foreach ($lang_name as $key=>$names)

                            @if ($key == $item->lang)

                                

                                <li>

                                    <a href="{{ route('other_language_tool', ['lang'=> $item->lang , 'slug' => $item->slug]) }}" />

                                        {{$names}}  {{ Str::upper($item->lang) }}

                                    </a>

                                </li>

                            @endif

                        @endforeach

                      

                        @endif  

                    @endforeach
                    @endif


                </ul>

            </div>

        </div>

    </div>

</header>

<div class="side_menu">

    <a href="{{ route('native_language_tool', ['slug' => 'roll-a-dice']) }}" class="side_menu_option"><i class="icon-colored icon-dice icon-3x"></i></a>

    <a href="{{ route('native_language_tool', ['slug' => '2048']) }}" class="side_menu_option"><i class="icon-colored icon-2048 icon-3x"></i></a>

    <a href="{{ route('home') }}" class="side_menu_option"><i class="icon-colored icon-flip-coin icon-3x"></i></a>

</div>

