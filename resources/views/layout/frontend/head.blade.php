@include('layout.frontend.meta')

{{-- ADD HEAD FROM HERE --}}

<link rel="stylesheet" href="{{ asset('web_assets/frontend/css/flipacoin.css') }}" />

<link rel="stylesheet" href="{{ asset('web_assets/frontend/css/icon.css') }}" />

<link rel="stylesheet" href="{{ asset('web_assets/frontend/css/contact.css') }}" />

<link rel="stylesheet" href="{{ asset('web_assets/frontend/css/dice-roller.css') }}" />

<link rel="stylesheet" href="{{ asset('web_assets/frontend/css/style.css') }}" />
<script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "WebSite",
      "name": "Flip A Coin",
      "url": "https://flipacoin.live/",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://flipacoin.live/search?q=){search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
    
    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org/", 
      "@type": "BreadcrumbList", 
      "itemListElement": [{
        "@type": "ListItem", 
        "position": 1, 
        "name": "Dice Roller",
        "item": "https://flipacoin.live/dice-roller.html"  
      },{
        "@type": "ListItem", 
        "position": 2, 
        "name": "2048 Game",
        "item": "https://flipacoin.live/2048.html"  
      }]
    }
    </script>

@stack('style')

