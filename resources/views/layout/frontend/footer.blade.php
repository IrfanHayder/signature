<footer class="footer_container">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}">Heads or Tails</a></li>
            <li><a href="{{ route('native_language_tool', ['slug' => 'roll-a-dice']) }}">Roll a dice</a></li>
            <li><a href="{{ route('native_language_tool', ['slug' => '2048']) }}">Play 2048</a></li>
            <li><a href="{{ route('page.contact_us') }}">Contact</a></li>
            <li><a href="{{ route('privacy_policy') }}">Privacy & Policy</a></li>
        </ul>
    </div>
</footer>

@include('layout.frontend.script')
